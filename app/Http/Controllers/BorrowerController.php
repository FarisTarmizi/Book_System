<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Student;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isNull;

class BorrowerController extends Controller
{
    public function name()
    {
        $user = Auth::user();
        return $user->name;
    }

    public function noti()
    {
        $user = Auth::user();
        $details = Student::where('user_email', $user->email)->first();
        return $details->status;
    }

    public function mail()
    {
        $user = Auth::user();
        return $user->email;
    }

    public function form()//user detail
    {
        $user = Auth::user();
        return view('user/detail_form', compact('user'));
    }

    public function wait()
    {

        return view('user/wait');
    }

    public function form_p(Request $request)
    {
        $data = [
            'name' => $request->fullName,
            'ic' => $request->matrix,
            'user_email' => $request->email,
            'department' => $request->department,

        ];

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
        if ($result) {
            return redirect()->route('borrower.home');
        } else {
            return redirect()->route('welcome')->with('error', 'Failed to insert data');
        }

    }

    public function dash()
    {
        $details = Student::where('user_email', $this->mail())->first();
        $l_book = [];
        $lb = "CURRENT BORROWING";


        //Status = P->Pending, A->approve, D->Declined, B->borrowing,
        if (!is_null($details->i_num)) {
            $book = explode(',', trim(preg_replace('/\s+/', '', $details->i_num), "\n\r\t\v\0"));
            if (count($book) > 0) {
                foreach ($book as $item) {
                    $result = Book::where('i_num', $item)->first();
                    if ($result) {
                        $l_book[] = $result->title;
                    }
                }
            }
            if ($details->status == 'P') {
                $lb = "PENDING APPROVAL";
            } elseif ($details->status == 'A') {
                $lb = "WAITING FOR PICKUP";
            }
        }
        $book_borrow = Book::where('available', 'NO')->get();
        $book_avail = Book::where('available', null)->get();
        $data2 = User::where('role', 1)->get();//all admin
        $ttl_book = Book::get();//all book
        $new_book = Book::orderBy('created_at', 'desc')->take(4)->get();//4 latest books
        return view('user/dashboard', ['u_nme' => $this->name(), 'detail' => $details, 'nme' => 'Name', 'mail' => 'Email',
            'ic' => 'ID', 'bme' => 'Current Books Borrowing', 'list' => $l_book, 'borrow' => $book_borrow, 'user' => $data2, 'book' => $new_book, 'book_num' => $ttl_book,
            'avail' => $book_avail, 'lb' => $lb, 'pend' => $this->noti()]);
    }

    public function req_b()
    {
        $details = Student::where('user_email', $this->mail())->first();
        return view('user/req_book', ['u_nme' => $this->name(), 'data' => $details, 'pend' => $this->noti()]);
    }

    public function req_bp(Request $request)
    {
        $data = [
            'i_num' => $request->bookId,
            'num_day' => $request->num_day,

        ];
//        dd($request);
        $user = Student::findOrFail($request->id);
        if (!(is_null($user->deadline) && is_null($user->date_borrow))) { //currently borrowing
            //Student::whereId($request->id)->update(['status' => 'P', 'i_num' => $data['i_num'], 'num_day' => $data['num_day']]);
            dd($user);

        } elseif ($user->status == 'P') {

        } else {
            Student::whereId($request->id)->update(['status' => 'P', 'i_num' => $data['i_num'], 'num_day' => $data['num_day']]);
            return redirect()->route('borrower.dash')->with('success', 'Book Requested');
        }

    }

    public function index()//checking user authorization
    {
        $user = Auth::user();
        $details = Student::where('user_email', $this->mail())->first();
        if ($details && $user->role == 0) {
            session()->flash('welcome', 'WELCOME BACK ' . strtoupper($details->name));
            return redirect()->route('borrower.dash');
        } elseif ($details && $user->role == 2) {
            //dd($user,$details);
            return redirect()->route('borrower.wait')->with('info', 'Your application has been submit to administrator, please bear with us waiting for the approval');
        } else {
            Auth::guard('web')->logout();
            return redirect()->route('welcome')->with('error', 'You Are Not In Our Data');
        }
    }

    public function l_book()
    {
        $details = Book::get();
        return view('user/l_book', ['details' => $details, 'u_nme' => $this->name(), 'pend' => $this->noti()]);
    }

    public function pickup($id)
    {
        $details = Student::findOrFail($id);
        if ($details) {
            $new = explode(',', $details->i_num);
            $date_c = new DateTime();
            $end_date = $date_c->modify("+" . ($details->num_day + 1) . "days");
            $result = Student::where('id', $id)->update(['deadline' => $end_date, 'status' => 'B'
                , 'date_borrow' => (new DateTime())->format('Y-m-d')]);
            if ($result) {
                foreach ($new as $t) {
                    Book::where('i_num', $t)->update(['available' => 'NO', 'id_borrower' => $details->ic]);
                }
                return redirect()->route('borrower.dash')->with('success', 'Thank You :) \n Enjoy Your Reading');
            } else
                return redirect()->route('borrower.status')->with('error', 'Error occurred.Please try again later');

        } else
            return redirect()->route('borrower.status')->with('error', 'Error occurred.Please try again later');
    }

    public function status()
    {
        $details = Student::where('user_email', $this->mail())->first();
        if (!(is_null($details->num_day) && is_null($details->i_num))) {
            $l_book = [];
            $book = explode(',', trim(preg_replace('/\s+/', '', $details->i_num), "\n\r\t\v\0"));
            if (count($book) > 0) {
                foreach ($book as $item) {
                    $result = Book::where('i_num', $item)->first();
                    if ($result) {
                        $l_book[] = $result->title;
                    }
                }
            }

            return view('user/status', ['data' => $details, 'list' => $l_book, 'u_nme' => $this->name(), 'pend' => $this->noti()]);
        } else
            return view('user/status', ['data' => $details, 'u_nme' => $this->name(), 'pend' => $this->noti()]);
    }
}
