import { Component } from '@angular/core';
import { NavController, AlertController, NavParams} from 'ionic-angular';

import { ApiService } from '../../services/api.services';

@Component({
  selector: 'page-curso',
  templateUrl: 'curso.html'
})
export class CursoPage {
	item = {
    id: '',
    titulo: ''
  };
  itemsList = [];

	constructor(
		public api: ApiService,
    public navParams: NavParams,
		public navCtrl: NavController,
		public alertCtrl: AlertController
	) {
    this.item.id = navParams.get('id');
	}

	ionViewDidLoad() {
    	this.searchDataIndex();
    }

    searchDataIndex(){
  		let me = this;
  		me.showLoading(); 
	    
  		me.api.requestShow(this.item.id)
  		.then(result => {
  			me.hiddenLoading();
  			me.item = result.data;
        me.itemsList = result.imagens;
  		}, error => {
        	me.showError("Ops. Ocorreu um erro no sistema");
      	});
  	}

  	showLoading() {
        let body = document.body;
        body.classList.remove('loaded');
    }

    hiddenLoading(){
        let body = document.body;
        body.classList.add('loaded');
    }

    showError(text) {
        this.hiddenLoading();
        let alert = this.alertCtrl.create({
              title: 'Atenção',
              subTitle: text,
              buttons: ['OK']
        });
        alert.present();
    }

}
