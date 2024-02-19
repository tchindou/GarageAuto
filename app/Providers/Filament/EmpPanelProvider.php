<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class EmpPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('emp')
            ->path('employe')
            ->spa()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Emp/Resources'), for: 'App\\Filament\\Emp\\Resources')
            ->discoverPages(in: app_path('Filament/Emp/Pages'), for: 'App\\Filament\\Emp\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Emp/Widgets'), for: 'App\\Filament\\Emp\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->login()
            ->registration()
            ->passwordReset()
            //->emailVerification()
            ->profile()
            ->loginRouteSlug('login')
            ->registrationRouteSlug('register')
            ->passwordResetRoutePrefix('password-reset')
            ->passwordResetRequestRouteSlug('request')
            ->passwordResetRouteSlug('reset')
            // ->emailVerificationRoutePrefix('email-verification')
            // ->emailVerificationPromptRouteSlug('prompt')
            // ->emailVerificationRouteSlug('verify')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
