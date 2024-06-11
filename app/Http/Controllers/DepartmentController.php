<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Http\Requests\StoreDepartment;
use App\Http\Requests\UpdateDepartment;
use App\Http\Requests\SearchDepartment;
use Illuminate\Database\Eloquent\Builder;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Department::with(['superiorDepartment', 'parentDepartment', 'subDepartments', 'embassador'])->get();

        return DepartmentResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartment $request)
    {
        $validated = $request->validated();

        $data = Department::create([
            'name' => $validated['name'],
            'superior_id' => $validated['superior_id'],
            'parent_id' => $validated['parent_id'],
            'embassador_id' => $validated['embassador_id'],
        ]);

        return new DepartmentResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return new DepartmentResource($department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartment $request, Department $department)
    {
        $validated = $request->validated();

        $department = Department::create([
            'name' => $validated['name'],
            'superior_id' => $validated['superior_id'],
            'parent_id' => $validated['parent_id'],
            'embassador_id' => $validated['embassador_id'],
        ]);

        return new DepartmentResource($department);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return response()->json(null, 204);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subdepartments(Department $department)
    {
        $data = $department->subDepartments;

        return DepartmentResource::collection($data);
    }

    /**
     * Ejemplo de uso del endpoint:
     * curl --location 'https://test-back.tahuaclub.com/api/departments/searchByColumn' \
     * --header 'Accept: application/json' \
     * --header 'Content-Type: application/json' \
     * --data '{
     *     "text": "embajador",
     *     "value": "Zander Barton IV"
     * }'
     *
     * @return \Illuminate\Http\Response
     */
    public function searchByColumn(SearchDepartment $request)
    {
        $validated = $request->validated();
        $value = '%' . $validated['value'] .'%';

        switch ($validated['text']) {
            case 'division':
                $data = Department::where('name', 'like', $value)->get();
                break;
            case 'division_superior':
                $data = Department::whereHas('superiorDepartment', function (Builder $query) use ($value) {
                    $query->where('name', 'like', $value);
                })->get();
                break;
            case 'colaboradores':
            case 'nivel':
                // No es posible, debido a que es un dato random
            case 'subdivisiones':
                break;
            case 'embajador':
                $data = Department::whereHas('embassador', function (Builder $query) use ($value) {
                    $query->where('name', 'like', $value);
                })->get();
                break;
            default:
                break;
        }

        return DepartmentResource::collection($data);
    }
}
