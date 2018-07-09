import {ModuleWithProviders} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';

import {AuthGuard} from './helpers/auth.guard';
import {LoginComponent} from './components/login/login.component';
import {EventComponent} from './components/event/event.component';
import {ProfileComponent} from './components/profile/profile.component';
import {AddEventComponent} from './components/add-event/add-event.component';
import {ConfirmSignupComponent} from './components/confirm-signup/confirm-signup.component';
import {ForgotPasswordComponent} from './components/forgot-password/forgot-password.component';
import {PasswordResetComponent} from './components/password-reset/password-reset.component';
import {RegisterComponent} from './components/register/register.component';
import {EventsComponent} from './components/events/events.component';
import { DonateComponent } from './components/donate/donate.component';
import { EditEventComponent } from './components/edit-event/edit-event.component';
import { EventResolve } from './services/event.resolve.service';

const loginRoutes: Routes = [
    {path: '', component: RegisterComponent},
    {path: 'forgot-password', component: ForgotPasswordComponent},
    {path: 'password-reset', component: PasswordResetComponent},
];

export const router: Routes = [
    {path: '', redirectTo: '/events', pathMatch: 'full'},
    {path: 'login', component: LoginComponent, children: loginRoutes, data: {title: 'Login'}},
    {path: 'password-reset', redirectTo: 'login/password-reset', data: {title: 'Reset password'}},
    {path: 'confirm-sign-up', component: ConfirmSignupComponent, data: {title: 'Confirm sign up'}},
    {path: 'add-event', component: AddEventComponent, canActivate: [AuthGuard], data: {title: 'Add Event'}},
    {path: 'profile', component: ProfileComponent, canActivate: [AuthGuard], data: {title: 'Profile'}},
    {path: 'donate', component: DonateComponent, canActivate: [AuthGuard], data: {title: 'Donate'}},
    {path: 'events', component: EventsComponent, canActivate: [AuthGuard], data: {title: 'Events List'}},
    {
        path: 'event/:id',
        component: EventComponent,
        canActivate: [AuthGuard],
        resolve: {
            post: EventResolve
        },
        data: {title: 'Event'}
    },
    {
        path: 'edit-event/:id',
        component: EditEventComponent,
        canActivate: [AuthGuard],
        resolve: {
            post: EventResolve
        },
        data: {
            title: 'Edit Event'
        }
    },
    {path: '**', redirectTo: '/login'}
];

export const routes: ModuleWithProviders = RouterModule.forRoot(router);