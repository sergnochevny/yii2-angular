import {Component, OnInit} from '@angular/core';
import {AlertService} from '../../services/alert.service';
import {AuthenticationService} from "../../services/authentication.service";
import {Router} from "@angular/router";

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.sass']
})
export class LoginComponent implements OnInit {

    csrf_token: string;
    csrf: string;

    constructor(private authService: AuthenticationService,
                private alertService: AlertService,
                private router: Router) {
    }

    ngOnInit() {
        this.processing(true);
        let user = localStorage.getItem('currentUser');
        if (user) {
            let form = new FormData();

            this.csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            this.csrf = document.querySelector('meta[name="csrf-param"]').getAttribute('content');
            form.append(this.csrf, this.csrf_token);

            this.authService
                .checkAuth(form)
                .subscribe(
                    data => {
                        if (data.result == true) {
                            user = JSON.stringify(data.data.User);
                            localStorage.setItem('currentUser', user);
                            this.authService.user = user;
                            this.router.navigate(['events']);
                        } else {
                            this.authService.user = null;
                        }
                        this.processing(false);
                    },
                    error => {
                        this.authService.user = null;
                        this.processing(false);
                    }
                );
        } else {
            this.processing(false);
        }
    }

    processing(inProgress) {
        this.alertService.processing(inProgress);
    }

}
