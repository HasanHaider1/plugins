import './component/MyAboshop/form/sw-datepicker';
let a = document.createElement('script');
a.setAttribute('src','https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js');
document.getElementsByTagName("head")[0].append(a);
let m = setInterval(function (){ $(document).ready(function()
{
    console.log('working')
})
}, 2000);
let w = document.createElement('script');
w.setAttribute('src','https://code.jquery.com/ui/1.12.1/jquery-ui.js');


let r = document.createElement('link');
r.setAttribute('href','css/jquery.datepick.css');
r.setAttribute('rel','stylesheet');

let t = document.createElement('script');
t.setAttribute('src','js/jquery.plugin.js');

let y = document.createElement('script');
y.setAttribute('src','js/jquery.datepick.js');

document.getElementsByTagName("head")[0].append(w);
document.getElementsByTagName("head")[0].append(r);
document.getElementsByTagName("head")[0].append(t);
