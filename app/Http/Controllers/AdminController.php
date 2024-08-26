<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Student;
use App\Models\User;

use Illuminate\Http\Request;
use DateTime;
use Dotenv\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dash() //dashboard
    {
        $data = [];
        $verified = User::where('role',0)->get();
        if ($verified){
            foreach ($verified as $item){
                $data [] = Student::where('user_email',$item->email)->get();
            }
        }
        $book_borrow = Book::where('available', 'NO')->get();
        $book_avail = Book::where('available', null)->get();
        $data2 = User::where('role', 1)->get();//all admin
        $ttl_book = Book::get();//all book
        $new_book = Book::orderBy('created_at', 'desc')->take(4)->get();//4 latest books
        return view('management/dashboard', ['u_nme' => $this->name(), 'nme' => 'Name', 'mail' => 'Email', 'ic' => 'ID', 'dt' => 'Date Borrow',
            'borrower' => $data, 'borrow' => $book_borrow, 'user' => $data2, 'book' => $new_book, 'book_num' => $ttl_book,
            'avail' => $book_avail, 'pend' => $this->noti()]);
    }

    public function index() //redirect to dashboard with welcome message
    {
        session()->flash('welcome', 'WELCOME BACK ' . strtoupper($this->name()));
        return redirect()->route('admin.dash');
    }

    public function name()//self-name
    {
        return Auth::user()->name;
    }

    public function noti()//get all pending user
    {
        return User::where('role', 2)->get();
    }

    public function data()
    {
        return view('management/borrower/register_student', ['pend' => $this->noti(), 'u_nme' => $this->name()]);
    }

    public function data2()//view registered borrower
    {
        $user = User:: where('role', 0)->get();
        $detail = [];
        if (!empty($user)) {
            foreach ($user as $item) {
                $detail[] = Student::where('user_email', $item->email)->first();
            }
        }

        return view('management/borrower/student', ['nme' => 'Name', 'ic' => 'ID',
            'pend' => $this->noti(), 'data' => $detail, 'u_nme' => $this->name()]);
    }

    public function l_user() //view all pending request user
    {
        $data = User::whereIn('role', [0, 2])->orderBy('created_at', 'desc')->get();//all borrower
        return view('management/borrower/pending_user', ['data' => $data, 'nme' => 'Name', 'mail' => 'Email',
            'dt' => 'Date Register', 'pend' => $this->noti(), 'u_nme' => $this->name()]);
    }

    public function lp_user($id)//approval pending request
    {
        $user = User::findOrFail($id);
        if ($user) {
            $process = User::where('id', $id)->update(['role' => 0]);
            if ($process)
                return redirect()->route('admin.l_user')->with('success', 'Success Approved');
            else
                return redirect()->route('admin.l_user')->with('error', 'Something Wrong On Process');
        } else {
            return redirect()->route('admin.l_user')->with('error', 'User Not Found');
        }
    }

    public function return_b($id)//book returning
    {
        $l_book = [];
        $data = Student::findOrFail($id);
        $book = explode(',', trim(preg_replace('/\s+/', '', $data->i_num), "\n\r\t\v\0"));
        if (count($book) > 0) {
            foreach ($book as $item) {
                $result = Book::where('i_num', $item)->first();
                if ($result) {
                    $l_book[] = $result->title;
                }
            }
        }
        return view('management/borrower/return_book', ['u_nme' => $this->name(), 'data' => $data, 'list' => $l_book, 'pend' => $this->noti()]);
    }

    public function detail($id)//borrower details
    {
        $name = [];
        $data = Student::findOrFail($id);
        $dj = User::where('email',$data->user_email)->get('updated_at');

        $cbb = 'Current Borrowed Books';
        if (!is_null($data->i_num)) {
            $book = explode(',', trim(preg_replace('/\s+/', '', $data->i_num), "\n\r\t\v\0"));
            if (count($book) > 0) {
                foreach ($book as $item) {
                    $result = Book::where('i_num', $item)->first();
                    if ($result) {
                        $name[] = $result->title;
                    }
                }
            }
            if ($data->status == 'P')
                $cbb = 'Requested Books - pending for approval';

            return view('management/borrower/view_b', ['u_nme' => $this->name(), 'nme' => 'Name', 'ic' => 'ID', 'dt' => 'Date Borrow',
                'pfl' => 'Profile Picture', 'dpt' => 'Department', 'mail' => 'Email', 'nd' => 'Number of Days Borrow',
                'cbb' => $cbb, 'list' => $name, 'data' => $data, 'pend' => $this->noti(), 'dj' => $dj]);
        } else {
            return view('management/borrower/view_b', ['u_nme' => $this->name(), 'nme' => 'Name', 'ic' => 'ID', 'dt' => 'Date Borrow',
                'pfl' => 'Profile Picture', 'dpt' => 'Department', 'mail' => 'Email', 'nd' => 'Number of Days Borrow',
                'cbb' => 'Current Borrowed Books', 'list' => null, 'data' => $data, 'pend' => $this->noti(), 'dj' => $dj]);
        }

    }

    public function insert_data(Request $request)//register user with booking
    {
        $request->validate([
            'matrix'=> 'required|min:12|max:12',
            'name'=>'required',
            'email'=>'required|email',
            'department'=>'required',
            'password'=>'required|min:8',
            'img'=>'required|max:10240 ',
        ]);
        $data['ic'] = $request->matrix;
        $data['name'] = $request->name;
        $data['user_email'] = $request->email;
        $data['department'] = $request->department;
        $data['date_borrow'] = $request->date;
        $data['num_day'] = $request->num_day;
        $data['i_num'] = $request->bookId;

        //deadline calculation
        $date_c = new DateTime();
        $end_date = $date_c->modify("+" . ($data['num_day'] + 1) . "days");
        $data['deadline'] = $end_date->format('Y-m-d');

        //image restore process
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $filename = date('Y-m-d') . $img->getClientOriginalName();
            $path = '/borrower_photo/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($img));
            $data['img'] = $filename;
        } else {
            //default image
            $filename = 'default.png';
            $data['img'] = $filename;
        }

        //database insertion
        $result = Student::create($data);
        if ($result !== false) {
            $book = explode(',', $data['i_num']);
            if (sizeof($book) > 0) {
                foreach ($book as $item) {
                    Book::where('i_num', $item)->update(['available' => 'NO', 'id_borrower' => $data['ic']]);
                }
            }
            return redirect()->route('admin.home')->with('success', 'Data insert successfully');
        } else {
            return redirect()->route('admin.home')->with('error', 'Failed to insert data');
        }

    }

    public function approve($id)
    {
        Student::whereId($id)->update(['status' => 'A']);
        return redirect()->route('admin.list_b')->with('success', 'Success Approved');
    }

    public function edit_data($id)
    {
        $data = Student::findOrFail($id);
        return view('management/borrower/edit_user', ['data' => $data, 'pend' => $this->noti(), 'u_nme' => $this->name()]);
    }

    public function update_data(Request $request, $id)//updating data
    {
        $request->validate([
            'matrix'=> 'required|min:12|max:12',
            'name'=>'required',
            'email'=>'required|email',
            'department'=>'required',
            'img'=>'max:10240 ',
        ]);
        $data['ic'] = $request->matrix;
        $data['name'] = $request->name;
        $data['user_email'] = $request->email;
        $data['department'] = $request->department;
        $data['i_num'] = $request->bookId;
        $data['date_borrow'] = (new DateTime())->format('Y-m-d');

        //differencing old and new book by id checking
        $find = Student::findOrFail($id);
        $old = explode(',', $find->i_num);
        $new = explode(',', $data['i_num']);
        $useless = array_diff($old, $new);

        //new deadline calculation
        if (!empty($request->num_day) or $request->num_day != 0) {
            $date_c = new DateTime();
            $end_date = $date_c->modify("+" . ($request->num_day + 1) . "days");
            $data['deadline'] = $end_date;
            $data['num_day'] = $request->num_day;
        }

        //image process
        if ($request->hasFile('img')) {
            //remove existed image
            $old = Student::findOrFail($id);
            if ($old->img && Storage::disk('public')->exists('/borrower_photo/' . $old->img))
                Storage::disk('public')->delete('/borrower_photo/' . $old->img);
            // insert new image
            $img = $request->file('img');
            $filename = date('Y-m-d') . $img->getClientOriginalName();
            $path = '/borrower_photo/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($img));
            $data['img'] = $filename;
        }

        //database insertion
        $result = Student::whereId($id)->update($data);
        if ($result !== false) {
            if (!empty($data['i_num'])) {
                //update available book status
                foreach ($useless as $i) {
                    Book::where('i_num', $i)->update(['available' => null, 'id_borrower' => null]);
                }
                foreach ($new as $t) {
                    Book::where('i_num', $t)->update(['available' => 'NO', 'id_borrower' => $data['ic']]);
                }
            } else {
                Student::whereId($id)->update(['deadline' => null, 'i_num' => null, 'num_day' => null]);
                foreach ($old as $item) {
                    Book::where('i_num', $item)->update(['id_borrower' => null, 'available' => null]);
                }
            }
            return redirect()->route('admin.view_b', ['id' => $id])->with('success', 'Data updated successfully');
        } else {
            return redirect()->route('admin.view_b', ['id' => $id])->with('error', 'Failed to update data');
        }
    }

    public function rtrn_book($id)
    {
        $change = Student::findOrFail($id);
        //database insertion
        if ($change) {
            $result = Student::where('id', $id)->update(['i_num' => null, 'deadline' => null, 'date_borrow' => null, 'num_day' => null]);
            if ($result) {
                $result2 = Book::where('id_borrower', $change->ic)->update(['available' => null, 'id_borrower' => null]);
                if ($result2)
                    return redirect()->route('admin.view_b', ['id' => $id])->with('success', 'Book has been returned');
                else
                    return redirect()->route('admin.view_b', ['id' => $id])->with('error', 'Something Wrong With Book Process');
            } else {
                return redirect()->route('admin.view_b', ['id' => $id])->with('error', 'Something Wrong With Student Process');
            }
        } else {
            return redirect()->route('admin.view_b', ['id' => $id])->with('error', 'Cannot Find Student Data!');
        }
    }

    public function delete_data($id)
    {
        $result = Student::findOrFail($id);
        if ($result) {
            //reset deadline
            if (!is_null($result->deadline)) {
                Student::where('id', $id)->update(['deadline' => null]);
            }
            //reset book
            if (!empty($result->i_num)) {
                $book = explode(',', trim(preg_replace('/\s+/', '', $result->i_num),
                    "\n\r\t\v\0"));
                foreach ($book as $item) {
                    Book::where('i_num', $item)->update(['available' => null, 'id_borrower' => null]);
                }
            }
            $result->delete();
            return redirect()->route('admin.list_b')->with('success', 'Data Been Deleted');
        } else {
            return redirect()->route('admin.list_b')->with('error', 'Failed to delete data');
        }
    }
}
