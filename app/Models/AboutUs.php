<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AboutUs extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = "about_us";

    public function steps_process(): HasMany
    {
        return $this->hasMany(StepsProcess::class, 'about_us_id', 'id');
    }

    public function client_testimonial(): HasMany
    {
        return $this->hasMany(ClientTestimonial::class, 'about_us_id', 'id');
    }
    public function for_who_services(): HasMany
    {
        return $this->hasMany(ForWhoService::class, 'about_us_id', 'id');
    }
    public function  shortcut($locale, $about, $defaultLanguage)
    {
        if ($locale == 'en') {
            return [
                'company_name' => $about->en_company_name ?? __('app.lang_not_supported'),
                'introduction' => $about->en_introduction ?? __('app.lang_not_supported'),
                'our_mission' => $about->en_our_mission ?? __('app.lang_not_supported'),
                'our_goals' => $about->en_our_goals ?? __('app.lang_not_supported'),
                'title_for_who' => $about->en_title_for_who ?? __('app.lang_not_supported'),
                'title_steps_process' => $about->en_title_steps_process ?? __('app.lang_not_supported'),
                'meet_our_team' => $about->en_meet_our_team ?? __('app.lang_not_supported'),
                'our_partners_associates' => $about->en_our_partners_associates ?? __('app.lang_not_supported'),
                'end' => $about->en_end ?? __('app.lang_not_supported'),
                "Steps Process" => "0",
                $about->steps_process = $about->steps_process->map(function ($related) use ($locale, $defaultLanguage, $about) {
                    $steps_process = [
                        'step_no' => $related->step_no,
                        'process_name' => $related->en_name ?? __('app.lang_not_supported'),
                        'process_description' => $related->en_description ?? __('app.lang_not_supported'),

                    ];
                    return $steps_process;
                }),
                "Client Testemonial" => "1",
                $about->client_testimonial = $about->client_testimonial->map(function ($related) use ($locale, $defaultLanguage, $about) {
                    $client_testimonial = [
                        "Title of Section" => "Here is Client Testemonial",
                        'client_testimonial' => $related->en_client_testimonial ?? __('app.lang_not_supported'),
                        'client_name' => $related->client_name ?? __('app.lang_not_supported'),

                    ];
                    return $client_testimonial;
                }),
                "Services For Who_" => "2",
                $about->for_who_services = $about->for_who_services->map(function ($related) use ($locale, $defaultLanguage, $about) {
                    $client_testimonial = [
                        'name_of_service_for_who' => $related->en_name ?? __('app.lang_not_supported'),
                        'description_of_service_for_who' => $related->en_description ?? __('app.lang_not_supported'),

                    ];
                    return $client_testimonial;
                })
            ];
        } else {
            return [
                'company_name' => $about->nl_company_name ?? __('app.lang_not_supported'),
                'introduction' => $about->nl_introduction ?? __('app.lang_not_supported'),
                'our_mission' => $about->nl_our_mission ?? __('app.lang_not_supported'),
                'our_goals' => $about->nl_our_goals ?? __('app.lang_not_supported'),
                'title_for_who' => $about->nl_title_for_who ?? __('app.lang_not_supported'),
                'title_steps_process' => $about->nl_title_steps_process ?? __('app.lang_not_supported'),
                'meet_our_team' => $about->nl_meet_our_team ?? __('app.lang_not_supported'),
                'our_partners_associates' => $about->nl_our_partners_associates ?? __('app.lang_not_supported'),
                'end' => $about->nl_end ?? __('app.lang_not_supported'),
                $about->steps_process = $about->steps_process->map(function ($related) use ($locale, $defaultLanguage, $about) {
                    $steps_process = [
                        'process_name' => $related->nl_name ?? __('app.lang_not_supported'),
                        'process_description' => $related->nl_description ?? __('app.lang_not_supported'),

                    ];
                    return $steps_process;
                }),
                $about->client_testimonial = $about->client_testimonial->map(function ($related) use ($locale, $defaultLanguage, $about) {
                    $client_testimonial = [
                        "Title of Section" => "Here is Client Testemonial",
                        'client_testimonial' => $related->nl_client_testimonial ?? __('app.lang_not_supported'),
                        'client_name' => $related->client_name ?? __('app.lang_not_supported'),

                    ];
                    return $client_testimonial;
                }),
                $about->for_who_services = $about->for_who_services->map(function ($related) use ($locale, $defaultLanguage, $about) {
                    $for_who_services = [
                        'name_of_service_for_who' => $related->nl_name ?? __('app.lang_not_supported'),
                        'description_of_service_for_who' => $related->nl_description ?? __('app.lang_not_supported'),

                    ];
                    return $for_who_services;
                })
            ];
        }
    }
}
