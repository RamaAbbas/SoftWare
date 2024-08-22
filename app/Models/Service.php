<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $table = "services";
    protected $guarded = ['id'];


    public function requirment(): HasMany
    {
        return $this->hasMany(Requirment::class, 'service_id', 'id');
    }

    public function service_benefits(): HasMany
    {
        return $this->hasMany(BenefitsForWho::class, 'service_id', 'id');
    }
    public function service_processs(): HasMany
    {
        return $this->hasMany(HowItWork::class, 'service_id', 'id');
    }
    public function client_testimonial(): HasMany
    {
        return $this->hasMany(ClientTestimonialService::class, 'service_id', 'id');
    }
    public function shortcut($locale, $service, $defaultLanguage)
    {
        if ($locale == 'en') {
            return [
                'name' => $service->en_name ?? __('app.lang_not_supported'),
                'description' => $service->en_description ?? __('app.lang_not_supported'),
                'title_of_requirments' => $service->en_title_of_requirments ?? __('app.lang_not_supported'),
                'title_of_how_it_works' => $service->en_title_of_how_it_works ?? __('app.lang_not_supported'),
                'title_of_service_benefit' => $service->en_title_of_service_benefit ?? __('app.lang_not_supported'),
                'title_call_to_action' => $service->en_title_call_to_action ?? __('app.lang_not_supported'),
                'sub_title_call_to_action' => $service->en_sub_title_call_to_action ?? __('app.lang_not_supported'),

                "Requirment" => "0",
                $service->requirment = $service->requirment->map(function ($related) use ($locale, $defaultLanguage) {
                    $requirment = [
                        'name' => $related->en_name ?? __('app.lang_not_supported'),
                        'description' => $related->en_description ?? __('app.lang_not_supported'),

                    ];
                    return $requirment;
                }),
                "Benefits" => "1",
                $service->service_benefits = $service->service_benefits->map(function ($related) use ($locale, $defaultLanguage) {
                    $service_benefits = [
                        'name' => $related->en_name ?? __('app.lang_not_supported'),
                        'description' => $related->en_description ?? __('app.lang_not_supported'),

                    ];
                    return $service_benefits;
                }),
                "Client Testimonial" => "2",
                $service->client_testimonial = $service->client_testimonial->map(function ($related) use ($locale, $defaultLanguage) {
                    $client_testimonial = [
                        'client_name' => $related->client_name ?? __('app.lang_not_supported'),
                        'client_testimonial' => $related->en_client_testimonial ?? __('app.lang_not_supported'),

                    ];
                    return $client_testimonial;
                }),
                "Service Processs" => "3",
                $service->service_processs = $service->service_processs->map(function ($related) use ($locale, $defaultLanguage) {
                    $service_processs = [
                        "Process Procedures" => "0",
                        'name' => $related->en_name ?? __('app.lang_not_supported'),
                        $related->process_procedures = $related->process_procedures->map(function ($subrelated) use ($locale, $defaultLanguage) {
                            $process_procedures = [
                                'name' => $subrelated->en_name ?? __('app.lang_not_supported'),
                                'description' => $subrelated->en_description ?? __('app.lang_not_supported'),

                            ];
                            return $process_procedures;
                        }),

                    ];
                   // return $service_processs;
                }),
            ];
        } else if($locale='nl') {
            return [
                'name' => $service->en_name ?? __('app.lang_not_supported'),
                'description' => $service->nl_description ?? __('app.lang_not_supported'),
                'title_of_requirments' => $service->nl_title_of_requirments ?? __('app.lang_not_supported'),
                'title_of_how_it_works' => $service->nl_title_of_how_it_works ?? __('app.lang_not_supported'),
                'title_of_service_benefit' => $service->nl_title_of_service_benefit ?? __('app.lang_not_supported'),
                'title_call_to_action' => $service->nl_title_call_to_action ?? __('app.lang_not_supported'),
                'sub_title_call_to_action' => $service->nl_sub_title_call_to_action ?? __('app.lang_not_supported'),

                "Requirment" => "0",
                $service->requirment = $service->requirment->map(function ($related) use ($locale, $defaultLanguage) {
                    $requirment = [
                        'name' => $related->nl_name ?? __('app.lang_not_supported'),
                        'description' => $related->nl_description ?? __('app.lang_not_supported'),

                    ];
                    return $requirment;
                }),
                "Benefits" => "1",
                $service->service_benefits = $service->service_benefits->map(function ($related) use ($locale, $defaultLanguage) {
                    $service_benefits = [
                        'name' => $related->nl_name ?? __('app.lang_not_supported'),
                        'description' => $related->nl_description ?? __('app.lang_not_supported'),

                    ];
                    return $service_benefits;
                }),
                "Client Testimonial" => "2",
                $service->client_testimonial = $service->client_testimonial->map(function ($related) use ($locale, $defaultLanguage) {
                    $client_testimonial = [
                        'client_name' => $related->client_name ?? __('app.lang_not_supported'),
                        'client_testimonial' => $related->nl_client_testimonial ?? __('app.lang_not_supported'),

                    ];
                    return $client_testimonial;
                }),
                "Service Processs" => "3",
                $service->service_processs = $service->service_processs->map(function ($related) use ($locale, $defaultLanguage) {
                    $service_processs = [
                        "Process Procedures" => "0",
                        'name' => $related->nl_name ?? __('app.lang_not_supported'),
                        $related->process_procedures = $related->process_procedures->map(function ($subrelated) use ($locale, $defaultLanguage) {
                            $process_procedures = [
                                'name' => $subrelated->nl_name ?? __('app.lang_not_supported'),
                                'description' => $subrelated->nl_description ?? __('app.lang_not_supported'),

                            ];
                            return $subrelated;
                        }),

                    ];
                    return $service_processs;
                }),
            ];
        }
    }
}
