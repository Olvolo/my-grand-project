<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- ВОТ ЭТА СТРОКА!
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User|null $user */
        $user = Auth::user();

        // Проверяем, что пользователь существует (авторизован) И у него есть флаг is_admin
        if ($user && $user->is_admin) {
            // Если да - пропускаем запрос дальше
            return $next($request);
        }

        // Если нет - прерываем запрос с ошибкой 403 "Доступ запрещен"
        abort(403, 'У вас нет прав для доступа к этой странице.');
    }
}
