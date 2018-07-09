import {Injectable} from '@angular/core';
import {RequestService} from "./request.service";

@Injectable()
export class EventsService extends RequestService {

    getCount(formData) {
        return this.send(formData, '/event/count');
    }

    getList(formData) {
        return this.send(formData, '/event');
    }

    getOne(id, formData) {
        return this.send(formData, '/event/view/' + id.toString());
    }

    addOne(formData) {
        return this.send(formData, '/event/create');
    }

    editOne(id, formData) {
        return this.send(formData, '/event/update/' + id.toString());
    }

}
