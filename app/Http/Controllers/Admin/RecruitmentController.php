<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRecruitmentRequest;
use App\Http\Requests\StoreRecruitmentRequest;
use App\Http\Requests\UpdateRecruitmentRequest;
use App\Recruitment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecruitmentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('recruitment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recruitments = Recruitment::all();

        return view('admin.recruitments.index', compact('recruitments'));
    }

    public function create()
    {
        abort_if(Gate::denies('recruitment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.recruitments.create');
    }

    public function store(StoreRecruitmentRequest $request)
    {
        $recruitment = Recruitment::create($request->all());

        return redirect()->route('admin.recruitments.index');
    }

    public function edit(Recruitment $recruitment)
    {
        abort_if(Gate::denies('recruitment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.recruitments.edit', compact('recruitment'));
    }

    public function update(UpdateRecruitmentRequest $request, Recruitment $recruitment)
    {
        $recruitment->update($request->all());

        return redirect()->route('admin.recruitments.index');
    }

    public function show(Recruitment $recruitment)
    {
        abort_if(Gate::denies('recruitment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.recruitments.show', compact('recruitment'));
    }

    public function destroy(Recruitment $recruitment)
    {
        abort_if(Gate::denies('recruitment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recruitment->delete();

        return back();
    }

    public function massDestroy(MassDestroyRecruitmentRequest $request)
    {
        Recruitment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
