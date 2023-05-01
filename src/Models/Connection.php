<?php

namespace Dev\Larabit\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
//use Laravel\Sanctum\HasApiTokens;

/**
 * Dev\Larabit\Models\WebHooks
 *
 * @property int $id
 * @property int $user
 * @property string $domain
 * @property string $path
 * @property string|null $external_user
 * @property string|null $token
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Connection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Connection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Connection query()
 * @method static \Illuminate\Database\Eloquent\Builder|Connection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Connection whereDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Connection whereExternalUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Connection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Connection wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Connection whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Connection whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Connection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Connection whereUser($value)
 * @mixin Eloquent
 */
class Connection extends Model
{
    use HasFactory;

    protected $table = self::tableName;

    /*** Constants ***/
    const tableName = 'larabit_connection';
    const user_id = 'user_id';
    const external_user_id = 'external_user_id';
    const domain = 'domain';
    const path = 'path';
    const token = 'token';
    const type = 'type';
    const typeList = ['inbound', 'outbound', 'internal'];
    const typeDefault = self::typeList[1];

    /*** Attributes ***/
    protected $fillable = [
        self::user_id,
        self::external_user_id,
        self::domain,
        self::path,
        self::token,
        self::type,
    ];

    protected static function newFactory(): \Database\Factories\ConnectionFactory
    {
        return \Database\Factories\ConnectionFactory::new();
    }
}
