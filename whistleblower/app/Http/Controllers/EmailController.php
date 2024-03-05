<?php

namespace App\Http\Controllers;

use App\Mail\EmailNotification;
use App\Models\MailTemplates;
use App\Models\UserCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Company/Email/Index', [
                'email_templates' => MailTemplates::templatesLists()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userCompanies = UserCompany::getUserCompanies();
        return Inertia::render('Company/Email/Create',[
            'user_companies' => $userCompanies,
            'is_admin' => (Auth::user()->hasRole('admin')) ? true : false,
            'company_id' => Session::get('company.id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'subject' => ['required'],
            'email_template' => ['required'],
            'company_id' => ['required'],
            'type' => ['required'],
        ])->validate();


        try {

            MailTemplates::updateOrCreate([
                'company_id' => $request->company_id,
                'type' => $request->type
            ],[
                'subject' => $request->subject,
                'mailable' => EmailNotification::class,
                'html_template' => $request->email_template,
                'company_id' => $request->company_id,
                'type' => $request->type,
            ]);

        } catch (\Exception $e) {
            dd($e);
            // Return a response with an error message
            return response()->json(['error' => 'An error occurred'], 500);
        }

        return redirect()->route('email.index')->with('message','Created the item successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mailTemplates = MailTemplates::find($id);
        $userCompanies = UserCompany::getUserCompanies();

        return Inertia::render('Company/Email/Edit', [
            'template' => $mailTemplates,
            'user_companies' => $userCompanies,
            'is_admin' => (Auth::user()->hasRole('admin')) ? true : false
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(),[
            'subject' => ['required'],
            'html_template' => ['required'],
            'company_id' => ['required']
        ])->validate();

        MailTemplates::find($id)->update($request->all());
        return redirect()->route('email.index')->with('message','Updated the item successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MailTemplates::find($id)->delete();
        return redirect()->route('email.index')->with('message','Deleted the item successfully');
    }
}
