function objectToSend(object) {
    let sending = "";
    for(let key in object){
        sending+='&'+key+"="+encodeURIComponent(object[key])
    }
    sending = sending.substring(1);
    return sending;
}

function ajaxSend(url,type,data=null) {
    return new Promise((res,ref)=>{
        const xhr=new XMLHttpRequest();

        xhr.open(type,url,true); 
        xhr.responseType="json";

        xhr.onload=()=>{
            xhr.readyState == 4 && xhr.status < 400 ? res(xhr.response) : ref(xhr.response);
        }

        xhr.onerror=()=>{
            ref(xhr.response);
        }

        let sendData = data || null;

        if(!(data instanceof FormData)) {
            sendData = objectToSend(data);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        }

        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="_token"]').content || '');
 
        xhr.send(sendData);
    });
}

class RequestApi {
    domain;
    constructor (domain) {
        this.domain = domain;
    }

    get(url) {
        return ajaxSend(this.domain + url,"GET");
    }

    post(url,data) {
        return ajaxSend(this.domain + url,"POST",data);
    }
}

function api(url) {
    return new RequestApi(url);
}

const APP_PATH = "http://127.0.0.1:8000";

const instance = api("http://127.0.0.1:8000");