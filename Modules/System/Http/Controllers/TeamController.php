<?php

namespace Modules\System\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Modules\System\Dao\Repositories\CompanyRepository;
use Modules\System\Dao\Repositories\GroupUserRepository;
use Modules\System\Dao\Repositories\HoldingRepository;
use Modules\System\Dao\Repositories\TeamRepository;
use Modules\System\Http\Requests\GeneralRequest;
use Modules\System\Http\Requests\LoginRequest;
use Modules\System\Http\Services\CreateService;
use Modules\System\Http\Services\DataService;
use Modules\System\Http\Services\DeleteService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Alert;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Notes;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Views;
use Modules\System\Http\Requests\DeleteRequest;

class TeamController extends Controller
{
    public static $template;
    public static $service;
    public static $model;

    public function __construct(TeamRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    public function index()
    {
        return view(Views::index())->with([
            'fields' => Helper::listData(self::$model->datatable),
        ]);
    }

    private function share($data = [])
    {
        $status = Helper::shareStatus(self::$model->status)->prepend('- Select Status -', '');
        $group = Helper::shareOption((new GroupUserRepository()));
        $company = Views::option(new CompanyRepository());
        $holding = Views::option(new HoldingRepository());

        $view = [
            'key' => self::$model->getKeyName(),
            'status' => $status,
            'group' => $group,
            'holding' => $holding,
            'company' => $company,
        ];

        return array_merge($view, $data);
    }

    public function create()
    {
        return view(Views::create())->with($this->share());
    }

    public function save(GeneralRequest $request, CreateService $service)
    {
        $data = $service->save(self::$model, $request);
        return Response::redirectBack($data);
    }

    public function data(DataService $service)
    {
        return $service
            ->setModel(self::$model)
            ->EditStatus(['active' => self::$model->status])
            ->make();
    }

    public function edit($code)
    {
        return view(Views::update())->with($this->share([
            'model' => $this->get($code),
        ]));
    }

    public function update($code, GeneralRequest $request, UpdateService $service)
    {
        $data = $service->update(self::$model, $request, $code);
        return Response::redirectBack($data);
    }

    public function show($code)
    {
        return view(Helper::setViewShow())->with($this->share([
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $this->get($code),
        ]));
    }

    public function get($code = null, $relation = null)
    {
        $relation = $relation ?? request()->get('relation');
        if ($relation) {
            return self::$service->get(self::$model, $code, $relation);
        }
        return self::$service->get(self::$model, $code);
    }

    public function delete(DeleteRequest $request, DeleteService $service)
    {
         $code = $request->get('code');
        $data = $service->delete(self::$model, $code);
        return Response::redirectBack($data);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('username', $request->username)->first();

        if (!Hash::check($request->password, $user->password)) {
            return Notes::error([
                'password' => 'Password Tidak Di temukan',
            ],'Login Gagal');
        }

        $token = $user->createToken($user->name);
        $string_token = $token->plainTextToken;
        $user->api_token = $string_token;
        $user->save();

        return response()->json(Notes::token($user->toArray()));
    }

    public function reset_password()
    {
        return view('auth.lock');
    }

    public function change_password(Request $request)
    {
        $this->validate($request, [
            'change_password' => 'required|min:8',
        ]);

        $password = $request->input('change_password');
        $data = self::$model->find(Auth::User()->id)->update([
            'password' => bcrypt($password),
        ]);
        Alert::create('Change password success !');
        return Response::redirectToRoute('reset');
    }

    public function reset_redis()
    {
        if (Auth::check()) {

            $key = auth()->user()->id;
            $access_menu = Auth::user()->username . '_access_menu';
            $group_list = Auth::user()->username . '_group_list';
            $access_user = 'App\User_By_Id_' . Auth::user()->$key;
            Cache::has($access_menu) ? Cache::forget($access_menu) : '';
            Cache::has($group_list) ? Cache::forget($group_list) : '';
            Cache::has('tables') ? Cache::forget('tables') : '';
            Cache::has('filter') ? Cache::forget('filter') : '';
            Auth::logout();
        }
        return redirect()->to('/');
    }

    public function reset_routing()
    {
        $this->reset_redis();
        Cache::forget('routing');

        return redirect()->to('/');
    }

    public function show_profile()
    {
        $data = self::$model->find(Auth::user()->{self::$model->getKeyName()});
        return view(Views::form('profile', 'team', 'system'))->with($this->share([
            'key' => self::$model->getKeyName(),
            'template' => 'user',
            'model' => $data,
        ]));
    }

    public function update_profile(GeneralRequest $request)
    {
        $data = self::$model->updateAuthRepository(Auth::user()->id, $request->all());
        return Response::redirectBack($data);
    }
}
