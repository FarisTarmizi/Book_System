<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\User;

use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function name()//self-details
    {
        return Auth::user()->name;
    }

    function index()
    {
        $data2 = DB::table('books')->leftJoin('students', 'id_borrower', '=', 'students.ic')->select('books.*', 'students.deadline as deadline')->get();
        return view('management/book/l_book', ['u_nme' => $this->name(), 'data2' => $data2, 'pend' => $this->noti()]);
    }

    public function noti()//get all pending user
    {
        return User::where('role', 2)->get();
    }

    function form()
    {
        return view('management/book/register', ['pend' => $this->noti(), 'u_nme' => $this->name()]);
    }

    function detail($id)
    {
        $data = Book::findOrFail($id);
        $data2 = Student::where('ic', $data->id_borrower)->first();
        return view('management/book/view', ['u_nme' => $this->name(), 'data' => $data, 'data2' => $data2, 'pend' => $this->noti()]);
    }

    function book()
    {
        $data = User::where('role', 0)->get();
        return view('management/book/booking', ['u_nme' => $this->name(), 'data' => $data, 'pend' => $this->noti()]);
    }

    function find(Request $request)
    {
        $user = User::where(['role' => 0, 'email' => $request->email])->first();
        if ($user) {
            $data = Student::where('user_email', $user->email)->first();
            return view('management/book/booking', ['u_nme' => $this->name(), 'data' => $data, 'pend' => $this->noti()]);
        } else
            return redirect()->route('admin.booking')->with('error', 'It occurred when the borrower not registered');
    }

    function insert(Request $request)
    {

        $data['i_num'] = $request->id;
        $data['title'] = $request->title;
        $data['author'] = $request->author;
        $data['description'] = $request->description;
        $data['price'] = $request->price;

        if ($request->hasFile('c_img')) {
            //image restore process
            $img = $request->file('c_img');
            $filename = date('Y-m-d') . $img->getClientOriginalName();
            $path = '/book_img/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($img));
            $data['c_img'] = $filename;
        }
        $result = Book::create($data);
        if ($result !== false) {
            return redirect()->route('admin.l_book')->with('success', 'Data insert successfully');
        } else {
            return redirect()->route('admin.l_book')->with('error', 'Failed to insert data');
        }
    }

    function update($id)
    {
        $result = Book::findOrFail($id);
        return view('management/book/edit_book', ['result' => $result, 'pend' => $this->noti(),
            'u_nme' => $this->name()]);

    }

    function update_process(Request $request, $id)
    {
        $request->validate([
            'c_img' => 'max:10240',
        ]);
        $data['i_num'] = $request->id;
        $data['title'] = $request->title;
        $data['author'] = $request->author;
        $data['description'] = $request->description;
        $data['price'] = $request->price;

        if ($request->hasFile('c_img')) {
            //remove existed image
            $old = Book::findOrFail($id);
            if ($old->c_img && Storage::disk('public')->exists('/book_img/' . $old->c_img))
                Storage::disk('public')->delete('/book_img/' . $old->c_img);
            // insert new image
            $img = $request->file('c_img');
            $filename = date('Y-m-d') . $img->getClientOriginalName();
            $path = '/book_img/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($img));
            $data['c_img'] = $filename;
        }
        $result = Book::whereId($id)->update($data);
        if ($result !== false) {
            return redirect()->route('admin.m_book', ['id' => $id])->with('success', 'Data updated successfully');
        } else {
            return redirect()->route('admin.m_book', ['id' => $id])->with('error', 'Failed to update data');
        }

    }

    public function delete_data($id)
    {
        $result = Book::findOrFail($id);
        if ($result) {
            $result->delete();
            return redirect()->route('admin.l_book')->with('success', 'Data Been Deleted');
        } else {
            return redirect()->route('admin.l_book')->with('error', 'Failed to delete data');
        }
    }
}
