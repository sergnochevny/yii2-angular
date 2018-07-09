// BASIC MODULES
import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {HttpModule} from '@angular/http';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import {APP_BASE_HREF, DatePipe, Location} from '@angular/common';

// CUSTOM COMPONENTS
import {AppComponent} from './components/app.component';
import {LoginformComponent} from './components/loginform/loginform.component';
import {RegisterComponent} from './components/register/register.component';
import {EventsComponent} from './components/events/events.component';
import {HeaderComponent} from './components/header/header.component';
import {EventComponent} from './components/event/event.component';
import {ProfileComponent} from './components/profile/profile.component';
import {AddEventComponent} from './components/add-event/add-event.component';
import {FooterComponent} from './components/footer/footer.component';
import {ConfirmSignupComponent} from './components/confirm-signup/confirm-signup.component';
import {ForgotPasswordComponent} from './components/forgot-password/forgot-password.component';
import {PasswordResetComponent} from './components/password-reset/password-reset.component';
import {LoginComponent} from './components/login/login.component';
import {AlertComponent} from './components/alert/alert.component';
import {LoaderComponent} from './components/loader/loader.component';
import {TeamComponent} from './components/team/team.component';
import {DonateComponent} from './components/donate/donate.component';
import {EditEventComponent} from './components/edit-event/edit-event.component';

// SERVICES
import {EventsService} from './services/events.service';
import {PagerService} from './services/pager.service';
import {AuthenticationService} from './services/authentication.service';
import {AlertService} from './services/alert.service';
import {DonationService} from './services/donation.service';

// ACCESSORIES

import {routes} from './app.routes';
import {AuthGuard} from './helpers/auth.guard';
import {EqualValidatorDirective} from './validators/equel-validator.directive';
import {FileValidator} from './validators/fileValidator.directive';

// LIBS
import {DateTimePickerModule} from 'ng-pick-datetime';
import {ImageCropperComponent, CropperSettings, Bounds} from './components/cropper';
import {CreditCardDirectivesModule} from 'angular-cc-library';
import {CurrencyMaskModule} from 'ng2-currency-mask';
import {EventResolve} from './services/event.resolve.service';


@NgModule({
    declarations: [
        AppComponent,
        LoginformComponent,
        RegisterComponent,
        EventsComponent,
        HeaderComponent,
        EventComponent,
        ProfileComponent,
        AddEventComponent,
        FooterComponent,
        EqualValidatorDirective,
        FileValidator,
        ConfirmSignupComponent,
        ForgotPasswordComponent,
        PasswordResetComponent,
        LoginComponent,
        TeamComponent,
        LoaderComponent,
        AlertComponent,
        ImageCropperComponent,
        DonateComponent,
        EditEventComponent
    ],
    imports: [
        BrowserModule,
        BrowserAnimationsModule,
        FormsModule,
        ReactiveFormsModule,
        HttpModule,
        routes,
        DateTimePickerModule,
        CreditCardDirectivesModule,
        CurrencyMaskModule
    ],
    providers: [
        AuthenticationService,
        AuthGuard,
        AlertService,
        EventsService,
        FileValidator,
        PagerService,
        DonationService,
        EventResolve,
        DatePipe
    ],
    bootstrap: [AppComponent]
})
export class AppModule {
}
