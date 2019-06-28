<?php

namespace App\Repositories;

use App\Models\User as Model;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAttribute;
use App\Models\Photo;
use Auth;
use Storage;
use App\Services\FileService;

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
        $columns = ['id', 'first_name', 'last_name', 'nick_name', 'email', 'city_id', 'group_id'];

        $result = $this
            ->startCondition()
            ->where('id', $id)
            ->select($columns)
            ->with('city:id,city_name,alias')
            ->with('userAttribute:user_id,age,gender,phone,eye_color,hair_color,height,weight,chest,waist,hip,clothing_size,foot_size,about,experience,is_tfp,is_commerce')
            ->with('groupName:id,group_name,alias')
            ->first();
        // dd($result);
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

    public function setPhotoId($id)
    {
        $photo = new Photo();
        $result = $photo->create(['user_id' => $id, 'name' => 'avatar', 'weight' => 250, 'height' => 260]);
        Storage::disk('user')->makeDirectory($id);
        Storage::disk('user')->makeDirectory($id . '/thumbs');

        return $result;
    }


    /////////////////////////////////////////////////////////////////////////////////
    /// Сохраняет данные профайла

    public function saveUserProfile($request)
    {
        //dd($request);
        $user = Auth::user();
        if (empty($request->first_name)) {
            $user->first_name = $user->nick_name;
        } else {
            $user->first_name = $request->first_name;
        }

        if (!empty($request->file('uploadFile'))) {
            $avatar = new FileService();
            $avatar->saveAvatar($request->file('uploadFile'), 'avatar.jpg');
            $userPhoto = $user->photos()->first();
            $userPhoto->size = $avatar->getFileSize('avatar.jpg');
            $user->photos()->save($userPhoto);
        }

        $user->last_name = $request->last_name;
        $user->group_id = $request->group_id;
        $user->city_id = $request->city_id;
        $user->profile_flag = TRUE;
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

    public function getProfileFlag()
    {
        $flag = $this
            ->startCondition()
            ->where('id', Auth::id())
            ->select('profile_flag')
            ->first();
        $result = $flag->profile_flag;

        return $result;
    }

    public function setProfileFlag($flag)
    {
        $user = Auth::user();
        $user->profile_flag = $flag;
        $user->save();
    }
}
