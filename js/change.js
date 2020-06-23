let select = document.querySelectorAll('.edit-select')[1];

let fields = document.querySelectorAll('.edit-bio-row');
function check () {
  if (select.options[select.selectedIndex].value === "write"){
      fields[10].insertAdjacentHTML("beforeend","<input type=\"text\" placeholder=\"Клуб\" name=\"club_name_2\" id=\"club_name_2\" class=\"register-form-some\">");
  }
  else {
      if (document.getElementsByName('club_name_2')){
         let a = document.getElementsByName('club_name_2')[0];
         console.log(a);
         a.remove();
      }
  }
}