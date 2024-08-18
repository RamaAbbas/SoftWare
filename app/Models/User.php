<?php

namespace App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use  HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

/*
1
gOYfNpGMw9icMYSuK2dTtm63tvJ8gVBXqbg7mlc7
 2
 LJKOeU2Ap3vnE63sqSQlXsjPB0Ew0QiWrYMgHCwL
*/


/* <div class="mask">
                                                        <p></p>
                                                        <div class="tools tools-bottom">
                                                            <a href="{{ route('service.show', $service->id) }}" ><i
                                                                    class="fa fa-link"></i></a>
                                                            <a href="{{ route('service.edit', $service->id) }}"><i
                                                                    class="fa fa-pencil"></i></a>
                                                          <!--  <a href=""><i
                                                                    class="fa fa-times"></i></a>-->
                                                            <!--     -->
                                                            <form action="{{ route('service.delete', $service->id) }}"
                                                                method="POST" style="display:grid;"
                                                                onsubmit="return confirm('Are you sure you want to delete this Service?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="" style="display:content"><i
                                                                        class="fa fa-times"></i></button>
                                                            </form>

                                                            <!-- -->
                                                        </div>
                                                    </div> */
