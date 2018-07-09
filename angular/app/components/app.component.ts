import {Component, Output, EventEmitter, OnInit} from '@angular/core';
import {AuthenticationService} from '../services/authentication.service';
import {RouterModule, Routes, Router, ActivatedRoute, Event, NavigationEnd} from '@angular/router';

import {AlertService} from '../services/alert.service';
import {Title} from '@angular/platform-browser';

import 'rxjs/add/operator/filter';
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/mergeMap';

@Component({
    selector: 'app-root',
    templateUrl: './app.component.html',
    styleUrls: ['./app.component.sass']
})
export class AppComponent implements OnInit {

    destination: string;

    showHeader: boolean = false;
    showFooter: boolean = false;

    csrf_token: string;
    csrf: string;

    constructor(private router: Router,
                private activatedRoute: ActivatedRoute,
                private authService: AuthenticationService,
                private titleService: Title) {

        router.events.subscribe(event => {
            if (event instanceof NavigationEnd) {
                this.showHeader = this.authService.logged;
                this.showFooter = this.authService.logged;
            }
        });

        this.destination = window.location.pathname;
    }

    ngOnInit() {
        this.csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        this.csrf = document.querySelector('meta[name="csrf-param"]').getAttribute('content');

        this.showHeader = this.authService.logged;
        this.showFooter = this.authService.logged;

        this.router.events
            .filter(event => event instanceof NavigationEnd)
            .map(() => this.activatedRoute)
            .map(route => {
                while (route.firstChild) route = route.firstChild;
                return route;
            })
            .filter(route => route.outlet === 'primary')
            .mergeMap(route => route.data)
            .subscribe((event) => this.titleService.setTitle(event['title']));
    }

}
