<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecruitmentRequest;
use App\Http\Requests\UpdateRecruitmentRequest;
use App\Http\Resources\Admin\RecruitmentResource;
use App\Recruitment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecruitmentApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('recruitment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RecruitmentResource(Recruitment::all());
    }

    public function store(StoreRecruitmentRequest $request)
    {
        $recruitment = Recruitment::create($request->all());

        return (new RecruitmentResource($recruitment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Recruitment $recruitment)
    {
        abort_if(Gate::denies('recruitment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RecruitmentResource($recruitment);
    }

    public function update(UpdateRecruitmentRequest $request, Recruitment $recruitment)
    {
        $recruitment->update($request->all());

        return (new RecruitmentResource($recruitment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Recruitment $recruitment)
    {
        abort_if(Gate::denies('recruitment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recruitment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
