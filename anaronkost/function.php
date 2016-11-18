<script>
function loadPage(pageURL,div)
{
    var xmlhttp;
    if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
      }
    else
      {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
        document.getElementById(div).innerHTML=xmlhttp.responseText;
        }
      }
    xmlhttp.open("GET",pageURL,true);
    xmlhttp.send();
}
function loadPagenewTab(content){
    myWindow=window.open(content, '_blank')
}
function refresh(element){
    document.getElementById(element).value='-';
}
function fixDate(date){
    
}
function disableElement(element,value){
    if(value!='-'){
        document.getElementById(element).removeAttribute('disabled');
    }else{
        document.getElementById(element).setAttribute('disabled','true');
    }
}
function checkSame(source,element1,element2,element3){
    var sourcev=document.getElementById(source).value;
    var e1=document.getElementById(element1).value;
    if(element2!='-'){
        var e2=document.getElementById(element2).value;
        if(sourcev==e2){
            refresh(element2)
        }
    }
    if(element3!='-'){
        var e3=document.getElementById(element3).value;
        if(sourcev==e3){
            refresh(element3)
        }
    }
    if(sourcev==e1){
        refresh(element1)
    }
}
</script>