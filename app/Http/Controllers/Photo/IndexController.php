<?php

namespace App\Http\Controllers\Photo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\GroupRepository;

class IndexController extends BaseController
{
    private $groupRepository;

    public function __construct()
    {
        parent::__construct();
        $this->groupRepository = app(GroupRepository::class);

    }

    public function init()
    {
        $itemsGroup = $this->groupRepository->getForSelectList();

        return view('photo.index', compact('itemsGroup'));
    }
}
