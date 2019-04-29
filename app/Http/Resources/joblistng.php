<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class joblistng extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'jobcategory' =>(string) $this->jobcategory,
            'requiredskill' => (string)$this->requiredskill,
            'role' => (string)$this->role,
            'min_qualification' =>(string) $this->min_qualification,
            'extra_skill' => (string)$this->extra_skill,
            'max_age' =>(string) $this->max_age,
            'expectedsalary' =>(string) $this->expectedsalary,
            'job_location' =>(string) $this->job_location,
            'working_hours' => (string)$this->working_hours,
            'jobdescription' =>(string) $this->jobdescription,
            'last_applydate' =>(string) $this->last_applydate,
            'status' => $this->status,
            'entrydate' =>(string) $this->entrydate,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
          ];
    }
}
