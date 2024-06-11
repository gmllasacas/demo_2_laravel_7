<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $division_superior = $this->whenLoaded('superiorDepartment', function () {
            return $this->superiorDepartment->name;
        });

        $embajador = $this->when('embassador', function () {
            return $this->embassador->name ?? '-';
        });

        return [
            'key' => $this->id,
            'division' => $this->name,
            'division_superior' => $division_superior ?? '-',
            'colaboradores' => $this->employees(),
            'nivel' => $this->level(),
            'subdivisiones' => $this->whenLoaded('subDepartments', function () {
                return count($this->subDepartments);
            }),
            'embajador' => $embajador,
        ];
    }
}
