<?php

use App\Http\Validations\Validation;
use App\User;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Attributes;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

/**
 * @param string $date
 * @return \Carbon\Carbon|null
 */
function parse_user_date(string $date): ?\Carbon\Carbon
{
    return parse_date($date, config('app.date_format', 'Y-m-d'));
}

/**
 * @param string $date
 * @param null|string $format
 * @return \Carbon\Carbon|null
 */
function parse_date(string $date, ?string $format = null): ?\Carbon\Carbon
{
    if (!$format) {
        $format = 'Y-m-d';
    }
    try {
        return \Carbon\Carbon::createFromFormat($format, $date, config('app.timezone'));
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::notice('Error parsing date: ' . $e->getMessage());
        return null;
    }
}

/**
 * @param string $time
 * @return \Carbon\Carbon|null
 */
function parse_user_time(string $time): ?\Carbon\Carbon
{
    return parse_time($time, config('app.time_format', 'H:i'));
}

/**
 * @param string $time
 * @return \Carbon\Carbon|null
 */
function parse_user_date_time(string $time): ?\Carbon\Carbon
{
    return parse_time($time, config('app.date_time_format', 'd/m/Y H:i'));
}

/**
 * @param string $time
 * @param null|string $format
 * @return \Carbon\Carbon|null
 */
function parse_time(string $time, ?string $format = null): ?\Carbon\Carbon
{
    if (!$format) {
        $format = 'H:i';
    }

    try {
        return \Carbon\Carbon::createFromFormat($format, $time, config('app.timezone'));
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::notice('Error parsing time: ' . $e->getMessage());
        return null;
    }
}


/**
 * @param $date
 * @return \Carbon\Carbon|null
 */
function format_api_date($date): ?\Carbon\Carbon
{
    return parse_date($date, config('app.api_date_format', 'j/m/Y'));
}

/**
 * @param \Carbon\Carbon $date
 * @param null $format
 * @return string
 */
function format_date(\Carbon\Carbon $date, $format = null)
{
    if (!$format) {
        $format = config('app.date_formt', 'd/m/Y');
    }

    return $date->format($format);
}

/**
 * @param \Carbon\Carbon $date
 * @param $format
 * @return string
 */
function format_time(\Carbon\Carbon $date, $format = null)
{
    if (!$format) {
        $format = config('app.time_format', 'H:i');
    }

    return $date->format($format);
}

/**
 * @param \Carbon\Carbon $date
 * @param $format
 * @return string
 */
function format_date_time(\Carbon\Carbon $date, $format = null)
{
    if (!$format) {
        $format = config('app.date_formt', 'd/m/Y') . ' ' . config('app.time_format', 'H:i');
    }

    return $date->format($format);
}

/**
 * @param string $function
 * @param null|string ...$params
 * @return string
 */
function db_raw_function(string $function, ?string ...$params): string
{
    $function = \Illuminate\Support\Str::lower($function);
    switch ($function) {
        case 'addtime':
            list($column, $value) = $params;
            return \Illuminate\Support\Facades\DB::raw("ADDTIME($column, SEC_TO_TIME({$value}))");
        case 'subtime':
            list($column, $value) = $params;
            return \Illuminate\Support\Facades\DB::raw("SUBTIME($column, SEC_TO_TIME({$value}))");
        default:
            list($column) = $params;
            return \Illuminate\Support\Facades\DB::raw("$function($column))");
            break;
    }
}

/**
 * @param string $module
 * @param array|null $default
 * @return array|null
 */
function get_last_user_search(string $module, ?array $default = null): ?array
{
    return session("SEARCH_{$module}", $default);
}

/**
 * @param string $module
 * @param array|null $value
 */
function set_last_user_search(string $module, ?array $value = null): void
{
    session(["SEARCH_{$module}" => $value]);
}

/**
 * @param string $module
 * @param int|null $default
 * @return int
 */
function get_module_per_page(string $module, int $default = 20): int
{
    return session("SEARCH_{$module}_PER_PAGE", $default);
}

/**
 * @param string $module
 * @param int $value
 */
function set_module_per_page(string $module, int $value = 20): void
{
    session(["SEARCH_{$module}_PER_PAGE" => $value]);
}

/**
 * @param string $module
 * @param int|null $default
 * @return int
 */
function module_per_page(string $module, ?int $default = 20): int
{
    $request = request('per_page');

    if ($request) {
        set_module_per_page($module, $request);
        return $request;
    }

    return get_module_per_page($module, $default);
}

/**
 * @return bool
 */
function auth_admin(): bool
{
    if (app()->runningInConsole()) {
        auth()->login(User::where('username', 'admin')->firstOrFail());
        return true;
    }

    return false;
}

/**
 * @param \Illuminate\Pagination\LengthAwarePaginator $originalPaginator
 * @return \Illuminate\Support\Collection
 */
function get_per_page_links(\Illuminate\Pagination\LengthAwarePaginator $originalPaginator): \Illuminate\Support\Collection
{
    $paginator = clone $originalPaginator;
    return collect([20, 50, 100, 160, 200, 500, 1000])->filter(function ($p) use ($paginator) {
        static $break = false;
        if (!$break) {
            if ($p >= $paginator->total()) {
                $break = true;
                return true;
            }
            return $p < $paginator->total();
        }

        return false;
    })->map(function ($p) use ($paginator) {
        if ($p != $paginator->perPage()) {
            return '<a class="btn-link" href="' . $paginator->appends(['per_page' => $p])->url(1) . '">' . $p . '</a>';
        }
        return "<strong>{$p}</strong>";
    });
}

/**
 * @param $modules
 * @param $permissions
 */
function abort_if_no_permission($modules, $permissions)
{
    if (!Validation::permissionsUser($modules, $permissions)) {
        abort(403, \Illuminate\Support\Facades\Lang::get('base_lang.no_permission'));
    }
}

function pagination($data, $perPorPage)
{
    $register = Collection::make($data);
    $pageName = 'page';

    $page = Paginator::resolveCurrentPage($pageName);

    return new LengthAwarePaginator($register->forPage($page, $perPorPage), $register->count(), $perPorPage, $page, [
        'path' => Paginator::resolveCurrentPath(),
        'pageName' => $pageName,
    ]);
}

/**
 * @return array
 */
function all_permissions(): array
{
    $modules = config('modules.modules', []) + DB::getSchemaBuilder()->getColumnListing('employees');
    $permissions = config('modules.base_permissions', []);

    $perms = [];
    foreach ($modules as $mod => $m) {
        foreach ($permissions as $perm => $p) {
            $perms[] = $perm . '_' . $mod;
        }
    }

    return $perms;
}

/**
 * @param array $permissions
 * @param User|null $user
 * @return bool
 */
function validatePermission(array $permissions, ?User $user = null): bool
{
    if (!$user) {
        $user = Auth::user();
    }

    try {
        return $user->isAdmin() || $user->hasAnyPermission($permissions);
    } catch (Exception $e) {
        \Illuminate\Support\Facades\Log::error($e->getMessage());
        return false;
    }
}

function remove_symbols($string)
{
    return trim($string);
}

/**
 * @param $string
 * @return mixed
 */
function cleanAccents($string)
{
    $accents = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹");
    $clean = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E");
    return str_replace($accents, $clean, $string);
}

function getYears($birthday)
{
    list($Y, $m, $d) = explode("-", $birthday);
    return (date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y);
}

/**
 * Format: 10 de mayo de 2018
 * @return string
 */
function getCurrentDate(?string $date = '')
{
    $months = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    if ($date == '') {
        $date = Carbon::now();
    } else if (gettype($date) == 'string') {
        $date = Carbon::parse($date);
    }

    $month = $months[($date->format('n')) - 1];

    return $date->format('d') . ' ' . $month . ', ' . $date->format('Y');
}

function getHour(?string $date = '')
{
    if ($date == '') {
        $date = Carbon::now();
    } else if (gettype($date) == 'string') {
        $date = Carbon::parse($date);
    }

    return $date->format('H:i') ?? '';
}
