import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import 'rxjs/add/operator/map';
/*
  Generated class for the LoginService provider.

  See https://angular.io/docs/ts/latest/guide/dependency-injection.html
  for more info on providers and Angular 2 DI.
*/
@Injectable()
export class ApiService {
  	public PARENT_BASE_API:string = 'http://192.168.10.103/ezoom/cursoV1/site/index.php/apiCursos/';

  	constructor(public http: Http) {}

    requestIndex(paramsObj): Promise<any> {
        return new Promise(resolve => {
            ;

            this.http.get(this.PARENT_BASE_API+'index')
            .map(res => res.json())
            .subscribe(data => {
                resolve(data);
            }, 
            err => {
                console.log(err);
                resolve({
                    success: false,
                    message: "Erro ao tentar se conectar com o servidor!"
                });
            });
        });
    }

    requestShow(id): Promise<any> {
        return new Promise(resolve => {
            ;

            this.http.get(this.PARENT_BASE_API+'show/'+id)
            .map(res => res.json())
            .subscribe(data => {
                resolve(data);
            }, 
            err => {
                console.log(err);
                resolve({
                    success: false,
                    message: "Erro ao tentar se conectar com o servidor!"
                });
            });
        });
    }

    public prepareParams(paramsObj): URLSearchParams {
        var searchParams = new URLSearchParams();
        for(var key in paramsObj){
            if(paramsObj.hasOwnProperty(key)){
                searchParams.set(key, paramsObj[key]);
            }
        }
        return searchParams;
    }
}
