<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'customerId' => $this->cust_id,
            'customerFirstname' => $this->cust_fname,
            'customerLastname' => $this->cust_lname,
            'customerEmail' => $this->cust_email,
            'customerPhone' => $this->cust_phone,
            'customerAddressFirst' => $this->cust_addr1,
            'customerAddressSecond' => $this->cust_addr2,
            'customerPostcode' => $this->cust_postcode,
            'customerRegisteredDate' => Carbon::parse($this->created_at)->toDateString()
        ];
    }
}
