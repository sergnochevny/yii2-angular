import {Component, OnInit} from '@angular/core';
import {NgForm} from '@angular/forms';
import {Router} from '@angular/router';

import {AlertService} from '../../services/alert.service';
import {EventsService} from '../../services/events.service';
import {PagerService} from '../../services/pager.service';

declare var jQuery: any;


@Component({
    selector: 'app-events',
    templateUrl: './events.component.html',
    styleUrls: ['./events.component.sass']
})
export class EventsComponent implements OnInit {

    /* UNCOMMENT BOOSTRAP-SELECT.JS IN MAIN.PHP TO TURN FILTERS ON */
    pageName = 'Events list';

    form;

    posts = [];
    Errors = [];

    csrf_token: string;
    csrf: string;

    filters: Object = {  // search filter params
        first: '',
        second: ''
    };

    search = '';

    // pager object
    pager: any = {
        currentPage: 0,
        pages: [],
        startPage: 1,
        totalPages: null
    };

    userInfo;

    pcAchieved: number;

    constructor(private eventService: EventsService,
                private alertService: AlertService,
                private pagerService: PagerService) {
    }

    ngOnInit() {
        this.csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        this.csrf = document.querySelector('meta[name="csrf-param"]').getAttribute('content');
        this.form = document.querySelector('form[name="SearchEvent"]');

        this.find();
        this.userInfo = JSON.parse((<any>window).localStorage.getItem('currentUser'));
    }

    protected processing(inProgress) {
        this.alertService.processing(inProgress);
    }

    sort(event, filter) {
        this.filters[filter] = event.target.value;
    }

    find() {
        let form = new FormData(this.form);
        form.append(this.csrf, this.csrf_token);

        this.getList(form);
    }


    page(num) {
        if (this.pagerService.currentPage !== num) {
            let form = new FormData(this.form);
            form.append(this.csrf, this.csrf_token);
            form.append('page', num);

            this.getList(form);
        }
    }

    private getList(form) {

        this.processing(true);
        // send to server
        this.eventService
            .getList(form)
            .subscribe(
                data => {
                    if (data.result === true) {
                        this.posts = data.data.model;
                        this.posts.forEach((el) => {  // format date
                            el.date_at = new Date(el.date_at * 1000);
                            el.pcAchieved = Math.floor((el.achieved / el.amount) * 100).toFixed(0);
                        });

                        const pagination = data.data.pagination; // server response
                        this.setPage(pagination.page, pagination.pageCount);
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

    private setPage(page: number, totalPages) {
        this.pager = this.pagerService.getPager(page, totalPages);
    }

    

}
