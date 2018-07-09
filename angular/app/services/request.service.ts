import {Headers, Http, RequestOptions, Response, URLSearchParams} from '@angular/http';
import {Observable} from 'rxjs/Observable';
import 'rxjs/add/observable/throw';
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/toPromise';
import 'rxjs/add/operator/catch';
import {Injectable} from "@angular/core";
import {AuthenticationService} from "./authentication.service";

@Injectable()
export class RequestService {

    constructor(protected http: Http) {
    }

    public send(formData, link) {
        let headers = new Headers();
        headers.set('Accept', 'application/json');
        headers.set('X-Requested-With', 'XMLHttpRequest');
        let options = new RequestOptions({ headers: headers });
        return this.http.post(link, formData, options)
            .map((response: Response) => {
            return response.json();
        }).catch((error) => {
            console.log(error);
            return Observable.throw(error);
        });
    }

}

