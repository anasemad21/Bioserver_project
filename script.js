
const test=document.getElementById('phone_2');
// alert(test);
    function validate(){
       
        if(test.value.length==0){alert("You must enter your phone");
        return false;}
        else{
            // alert("Done");
        return true;}

    }



const input=document.getElementById('seq');
const input_id=document.getElementById('gid');
 const standmax=0;
    function maxlengthh(){
    const max=input.value.length;
    const max_id=input.value.length;
    if(max==standmax||max_id==standmax){
        alert("You must enter seq and Gene ID");
        return false;
       
    }
    else{
        // alert("ok");
        return true;
    }
   

}