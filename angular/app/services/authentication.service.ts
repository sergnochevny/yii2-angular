import {Injectable} from '@angular/core';
import {RequestService} from "./request.service";
import 'rxjs/add/observable/throw';
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/toPromise';
import 'rxjs/add/operator/catch';

@Injectable()
export class AuthenticationService extends RequestService{

    logged: boolean = false;

    public user: any = null;

    checkAuth(formData) {
        return this.send(formData, '/login');
    }

    logout(formData) {
        return this.send(formData, '/logout');
    }

    login(formData) {
        return this.send(formData, '/login');
    }

    register(formData) {
        return this.send(formData, '/sign-up');
    }

    confirm(formData) {
        return this.send(formData, '/confirm-sign-up');
    }

    forgot(formData) {
        return this.send(formData, '/password-restore');
    }

    reset(formData) {
        return this.send(formData, '/password-reset');
    }


}

