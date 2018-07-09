import {Component, OnInit, Output, Input, EventEmitter} from '@angular/core';
import {Router, ActivatedRoute, NavigationEnd, ActivatedRouteSnapshot} from '@angular/router';
import {AuthenticationService} from '../../services/authentication.service';
import {AlertService} from '../../services/alert.service';

import {EventsService} from '../../services/events.service';

@Component({
    selector: 'app-header',
    templateUrl: './header.component.html',
    styleUrls: ['./header.component.sass']
})
export class HeaderComponent implements OnInit {
    @Input() title: string;

    csrf_token: string;
    csrf: string;
    form;

    postsAmount: number;

    constructor(private router: Router,
                private activatedRoute: ActivatedRoute,
                private authService: AuthenticationService,
                private alertService: AlertService,
                private eventsService: EventsService) {
        // GET EVENT COUNT ON EACH ROUTE CHANGE
        router.events.forEach((event) => {
            if (event instanceof NavigationEnd) {
                this.getCountEvents(this.form);
            }
        });

        // GET CURRENT ROUTE DATA TITLE
        this.router.events
            .filter(event => event instanceof NavigationEnd)
            .map(() => this.activatedRoute)
            .map(route => {
                while (route.firstChild) route = route.firstChild;
                return route;
            })
            .filter(route => route.outlet === 'primary')
            .mergeMap(route => route.data)
            .subscribe((event) => this.title = (event['title']));
    }

    protected processing(inProgress) {
        this.alertService.processing(inProgress);
    }


    ngOnInit() {
        this.csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        this.csrf = document.querySelector('meta[name="csrf-param"]').getAttribute('content');
        this.form = new FormData();
        this.form.append(this.csrf, this.csrf_token);
        this.getCountEvents(this.form);
    }

    logout() {
        let form = this.form;
        this.processing(true);

        this.authService
            .logout(form)
            .subscribe(
                data => {
                    if (data.result === true) {
                        localStorage.removeItem('currentUser');
                        this.authService.user = null;
                        this.authService.logged = false;
                        this.router.navigate(['login']);
                    } else {
                        console.log(data.errors);
                        if (data.errors.error) {
                            this.alertService.alert(data.errors.error, false);
                        }
                    }
                    this.processing(false);
                },
                error => {
                    console.log(error);
                    this.alertService.alert(error.toString(), false);
                    this.processing(false);
                }
            );
    }

    private getCountEvents(form) {
        if (this.authService.logged) {
            this.processing(true);
            // send to server
            this.eventsService
                .getCount(form)
                .subscribe(
                    data => {
                        if (data.result === true) {
                            this.postsAmount = data.data.total;
                        } else {
                            console.log(data.errors);
                            if (data.errors.error) {
                                this.alertService.alert(data.errors.error, false);
                            }
                        }
                        this.processing(false);
                    },
                    error => {
                        console.log(error);
                        this.alertService.alert(error.toString(), false);
                        this.processing(false);
                    }
                );
        }
    }
}
