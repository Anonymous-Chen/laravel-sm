<?php
/**
 * Created by PhpStorm.
 * User: Anonymou_Chen
 * Date: 2017/3/6
 * Time: 14:37
 */
namespace App\Http\Controllers;


use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller{
    public function index(){

        $students = Student::paginate(3);

        return view( 'student.index',[
            'students' => $students,
        ]);
    }

    //添加页面
    public function create(){
        return view('student.create');
    }

    //保存添加数据
    public function save( Request $request ){
        $data = $request->input('Student','未知');
        var_dump($data);
        var_dump( $data['name'] );
        $student = new Student();
        $res = $request->all();
        //dd( $res);
        if( $request->has($data['name'])){
            echo 'o';
           // echo  $request->input('name');
        }else{
            echo 'no';
        }
        $student->name = $data['name'];
        $student->sex = $data['sex'];
        $student->age = $data['age'];

        if( $student->save()){
            return redirect('student/index')->with('success','添加成功');
        }else{
            //var_dump($student);
            return redirect()->back();
        }

    }





    public function  a(){
//        $stus = Student::get();
//        dd($stus);
        $stus1 = Student::paginate(3);
        dd($stus1);

    }

    public function request1( Request $request)
    {
        $data = $request->input('Student','未知1');
        var_dump($data);
//        $res = $request->all();
//        dd( $res);
    }













}