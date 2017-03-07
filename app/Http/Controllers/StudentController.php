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

        $students = Student::paginate(5);

        return view( 'student.index',[
            'students' => $students,
        ]);
    }

    //添加页面
    public function create( Request $request){

        $student = new Student();

        if ( $request->isMethod('post')){
            //控制器验证
            //验证失败 代码恢复上一个页面 并抛出异常 获取错误信息
            /*
            $this->validate( $request , [
                'Student.name'=>'required|min:2|max:20',
                'Student.age'=>'required|integer',
                'Student.sex'=>'required|integer',
            ],[
                'required'=>':attribute 为必填项',
                'min'=>':attribute 输入最少两个字符',
                'max'=>':attribute 输入最多十五个字符',
                'integer'=>':attribute 必须填数字',
            ],[
                'Student.name'=>'姓名',
                'Student.sex'=>'性别',
                'Student.age'=>'年龄',
             ]
            );*/

            //2 Validator验证
            $validator = \Validator::make($request->input(),[
                    'Student.name'=>'required|min:2|max:20',
                    'Student.age'=>'required|integer',
                    'Student.sex'=>'required|integer',
                ],[
                    'required'=>':attribute 为必填项',
                    'min'=>':attribute 输入最少两个字符',
                    'max'=>':attribute 输入最多十五个字符',
                    'integer'=>':attribute 必须填数字',
                ],[
                        'Student.name'=>'姓名',
                        'Student.sex'=>'性别',
                        'Student.age'=>'年龄',
                 ]);

            //主动生成错误信息，$errors
            if ($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }



            $data = $request->input('Student');
            if (Student::create($data)){

                return redirect('student/index')->with('success','添加成功');
            }else{
                return redirect()->back();
            }
        }
        return view('student.create',[
            'student' => $student,
        ]);
    }

    public function update( Request $request ,$id ){

        $student = Student::find($id);

        if( $request->isMethod('post')){
            $data = $request->input('Student');

            $student->name = $data['name'];
            $student->sex = $data['sex'];
            $student->age = $data['age'];

            if ( $student->save()){
                return redirect('student/index')->with('success','修改成功-'.$id);
            }
        }
        return view( 'student.update',[
            'student' => $student,
        ]);
    }

    public function delete( $id ){

        Student::destroy($id);

        return redirect('student/index')->with('success','删除成功-'.$id);

    }

    public function detail( $id){

        $student = Student::find($id);

        return view( 'student.detail',[
            'student' => $student,
        ]);
    }

    //保存添加数据 未应用
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

}