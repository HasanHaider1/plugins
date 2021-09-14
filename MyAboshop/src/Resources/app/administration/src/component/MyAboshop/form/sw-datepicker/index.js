

const {Component}= Shopware;
Component.override('sw-datepicker',{
    mounted() {
        let x = document.getElementsByClassName('flatpickr-calendar');
        x[0].innerHTML=null;



        let b = document.createElement('input');
        b.setAttribute('id','datepicker');
        x[0].append(b);



        //$("#datepicker").multiDatesPicker(options_for_datepicker_and_mdp);



        $("#datepicker").datepick();

        //$("#datepicker").datepicker();
        console.log(this.value)
        console.log(newconfig)
    },



});