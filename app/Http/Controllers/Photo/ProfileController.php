<?php

namespace App\Http\Controllers\Photo;

use App\Http\Requests\SaveProfileRequest;
use App\Repositories\UserRepository;
use App\Repositories\GroupRepository;
use App\Repositories\CountryRepository;
use App\Repositories\RegionRepository;
use App\Repositories\CityRepository;
use App\Repositories\GenreRepository;
use App\Services\FormService;
use App\Models\User;
use App\Models\UserAttribute;

class ProfileController extends BaseController
{
    private $userRepository;
    private $groupRepository;
    private $countryRepository;
    private $regionRepository;
    private $cityRepository;
    private $genreRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = app(UserRepository::class);
        $this->groupRepository = app(GroupRepository::class);
        $this->countryRepository = app(CountryRepository::class);
        $this->regionRepository = app(RegionRepository::class);
        $this->cityRepository = app(CityRepository::class);
        $this->genreRepository = app(GenreRepository::class);
    }

    public function showProfile(FormService $formService)
    {
        $itemUserProfile = $this->userRepository->showUserProfile();
        $itemGroup = $this->groupRepository->getForSelectList();
        $itemMonth = $formService->getMonth();
        $itemDay = $formService->getDay();
        $itemYear = $formService->getYear();
        $itemExp = $formService->getExperience();
        $itemCountry = $this->countryRepository->getAllCountries();
        $itemRegion = $this->regionRepository->getAllRegions();
        $itemCity = $this->cityRepository->getAllCities();
        $itemGenre = $this->genreRepository->getAllGenres();
        
        return view('photo.profile', compact('itemUserProfile',
                                             'itemMonth', 
                                             'itemDay', 
                                             'itemYear', 
                                             'itemGroup',
                                             'itemCountry', 
                                             'itemRegion',
                                             'itemCity',
                                             'itemGenre',
                                             'itemExp'));
    }

    public function saveProfile(SaveProfileRequest $request, FormService $formService)
    {
        $formService->fullDateFromRequest($request);
        $item = $this->userRepository->saveUserProfile($request);
        if ($item) {
            return redirect()->route('show.profile');
        }else {
            return back()->withInput();
        }        
    }

}
