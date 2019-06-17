<?php

namespace App\Repositories;

use App\Models\User as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAttribute;
use Auth;

class UserRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    ////////////////////////////////////////////////////////////////////
    /////  Возвращает пользователя по id с полями указанными в $columns
    ////////////////////////////////////////////////////////////////////
    public function showUser($id)
    {
        $columns = ['id', 'first_name', 'last_name', 'age', 'nick_name', 'email', 'city_id'];

        $result = $this
                ->startCondition()
                ->where('id', $id)
                ->select($columns)
                ->with('city:id,city_name,alias')
                ->first();                

        return $result;
    }


    ///////////////////////////////////////////////////////////////////////////////
    /////  Регистрирует нового пользователя

    public function regUser(array $data)
    {
        $result = $this
                ->startCondition()                   
                ->create([
                        'nick_name' => $data['nick_name'],                        
                        'email' => $data['email'],
                        'password' => Hash::make($data['password']),                        
                        ]);

        return $result;
    }

    ///////////////////////////////////////////////////////////////////////////////////
    /////  Показывает данные нового зарегистрированного пользователя на странице профайла

    public function showUserProfile()
    {
        $columns = ['id', 'nick_name', 'email',];

        $result = $this
                ->startCondition()                
                ->where('id', Auth::id())
                ->select($columns)
                ->first();
        
        return $result;
    }

    //////////////////////////////////////////////////////////////////
    // Устанавливает в поле user_id таблицы user_attribute айдишник нового
    // зарегистрированного пользователя

    public function setUserAttributeId($id)
    {
        $userAttribute = new UserAttribute();
        $result = $userAttribute->create(['user_id' => $id]);

        return $result;
    }

    /////////////////////////////////////////////////////////////////////////////////
    /// Сохраняет данные профайла

    public function saveUserProfile($request)
    {
        $user = Auth::user();
        if (empty($request->first_name)) {
            $user->first_name = $user->nick_name;
        }else {
            $user->first_name = $request->first_name;
        }        
        $user->last_name = $request->last_name;
        $user->group_id = $request->group_id;
        $user->city_id = $request->city_id;
        $user->save();
        $userAttr = $user->userAttribute()->first();
        $userAttr->age = $request->age;
        $userAttr->phone = $request->phone;
        $userAttr->gender = $request->gender;
        $userAttr->eye_color = $request->eye_color;
        $userAttr->hair_color = $request->hair_color;
        $userAttr->weight = $request->weight;
        $userAttr->height = $request->height;
        $userAttr->chest = $request->chest;
        $userAttr->waist = $request->waist;
        $userAttr->hip = $request->hip;
        $userAttr->clothing_size = $request->clothing_size;
        $userAttr->foot_size = $request->foot_size;
        $userAttr->about = $request->about;
        $userAttr->experience = $request->exp;
        $userAttr->is_tfp = $request->tfp;
        $userAttr->is_commerce = $request->commerce;
        $user->userAttribute()->save($userAttr);
        
        return $user;
    }
}


?>