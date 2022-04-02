<?php

namespace Modules\ApplicationApi\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;

class ApplicationApiController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function loginapi(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'emailID' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),202);
        }
        try {
            $email = $request->emailID;
            $password = $request->password;
            if (Auth::attempt(['emailID' => $email, 'password' => $password])) {
                $user = Auth::user();
                $responseArray =[];
                $responseArray['name'] = $user->firstName." ".$user->lastName;
                $responseArray['token_'] = $user->createToken('MyApp')->accessToken;

                return response()->json($responseArray, $this->successStatus);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        } catch (Exception $th) {
            throw $th;
        }
    }

        /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function logindetails()
    {
        $data = Auth::user();
        $responseArray=[
            'data' => $data
        ];
        return response()->json($responseArray,200);
    }
    
    /**
 * Display a listing of the resource.
 * @return Renderable
 */
public function unauthor()
{
    $responseArray = ['error' => 'Not valid Json'];
    return response()->json($responseArray,200);
}
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('applicationapi::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('applicationapi::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('applicationapi::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('applicationapi::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
