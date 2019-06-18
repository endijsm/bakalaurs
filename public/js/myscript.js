var newElementID = 4785; // random number

function addInput(divName)
{ 
    var newdiv = document.createElement('div');
    if(divName == 'course_results_input')
    {
        newdiv.innerHTML = "<div id='"+newElementID+"'><div class='form-row'><div class='col-10'><input type='text' name='course_results[]' class='form-control' placeholder='Studiju kursa rezultāts'></div><div class='col'><span class='btn btn-outline-dark' onClick='removeElement("+newElementID+");'>-</span></div></div><br></div>";
    }
    if(divName == 'additional_course_results_input')
    {
        newdiv.innerHTML = "<div id='"+newElementID+"'><div class='form-row'><div class='col-10'><input type='text' name='additional_course_results[]' class='form-control' placeholder='Studiju kursa rezultāts'></div><div class='col'><span class='btn btn-outline-dark' onClick='removeElement("+newElementID+");'>-</span></div></div><br></div>";
    }
    else if(divName == 'independent_tasks_input')
    {
        newdiv.innerHTML = "<div id='"+newElementID+"'><div class='form-row'><div class='col-10'><input type='text' name='independent_tasks[]' class='form-control' placeholder='Patstāvīgais darbs'></div><div class='col'><span class='btn btn-outline-dark' onClick='removeElement("+newElementID+");'>-</span></div></div><br></div>";
    }
    else if(divName == 'evaluation_input')
    {
        newdiv.innerHTML = "<div id='"+newElementID+"'><div class='input-group'><input type='text' name='percent[]' placeholder='30' class='form-control col-sm-1'><div class='input-group-prepend'><span class='input-group-text'>%</span></div><input type='text' name='evaluation[]' placeholder='Novērtējuma veids' class='form-control col-sm-9'>&emsp;<span class='btn btn-outline-dark' onClick='removeElement("+newElementID+");'>-</span></div><br></div>";
    }
    else if(divName == 'course_subjects_input')
    {
        newdiv.innerHTML = "<div id='"+newElementID+"'><div class='form-row'><div class='col-10'><input type='text' name='course_subjects[]' class='form-control' placeholder='Tēmas nosaukums'></div><div class='col'><span class='btn btn-outline-dark' onClick='removeElement("+newElementID+");'>-</span></div></div><br></div>";
    }
    else if(divName == 'calendar_plan_input')
    {
        newdiv.innerHTML = "<div id='"+newElementID+"'><div class='form-row'><div class='col-2'><input type='text' name='calendar_plan_lecture_num[]' class='form-control' placeholder='Nodarbības numurs'></input>" +
        "</div><div class='col-8'><textarea name='calendar_plan_subject[]' class='form-control' rows='3' placeholder='Tēmas nosaukums'></textarea>" +
        "</div><div class='col'><input type='text' name='calendar_plan_type[]' class='form-control' placeholder='Nodarbības veids'></input></div></div><span class='btn btn-outline-dark' onClick='removeElement("+newElementID+");'>-</span><br><br></div>";
    }
    else if(divName == 'basic_literature_input')
    {
        newdiv.innerHTML = "<div id='"+newElementID+"'><div class='form-row'><div class='col-10'><input type='text' name='basic_literature[]' class='form-control' placeholder='Pamatliteratūra'></div><div class='col'><span class='btn btn-outline-dark' onClick='removeElement("+newElementID+");'>-</span></div></div><br></div>";
    }
    else if(divName == 'additional_literature_input')
    {
        newdiv.innerHTML = "<div id='"+newElementID+"'><div class='form-row'><div class='col-10'><input type='text' name='additional_literature[]' class='form-control' placeholder='Papildliteratūra'></div><div class='col'><span class='btn btn-outline-dark' onClick='removeElement("+newElementID+");'>-</span></div></div><br></div>";
    }
    else if(divName == 'other_information_sources_input')
    {
        newdiv.innerHTML = "<div id='"+newElementID+"'><div class='form-row'><div class='col-10'><input type='text' name='other_information_sources[]' class='form-control' placeholder='Citi informācijas avoti'></div><div class='col'><span class='btn btn-outline-dark' onClick='removeElement("+newElementID+");'>-</span></div></div><br></div>";
    }

    newElementID++;
    document.getElementById(divName).appendChild(newdiv);    
}

//var linked_results_counter = 2; // name with number 1 is already in html
function addDefineLinkedResults(select_option_array)
{ 
    var newdiv = document.createElement('div');
    
    // increment hidden form element - number_of_program_results
    var num_of_prog_res = document.getElementById("num_of_prog_res").value;
    num_of_prog_res++;
    document.getElementById("num_of_prog_res").value = num_of_prog_res;

    var newInputString = "<br><div class='form-row'><input type='text' name='course_results[]' class='form-control' placeholder='Studiju kursa rezultāts'></div><br><select multiple name='program_results"+num_of_prog_res+"[]' class='form-control' size='10'>";
    //newElementID++;

    var keys = Object.keys(select_option_array);
    var values = Object.values(select_option_array);
    
    for(i = 0; i < values.length; i++)
    {
        newInputString += "<option value='"+keys[i]+"'>"+values[i]+"</option>";
    }
    newInputString += "</select><br>";

    newdiv.innerHTML = newInputString;
    document.getElementById('linked_results_input').appendChild(newdiv);
}

function removeElement(element_id)
{
    /*
    var div = document.getElementById(div_id);  
    var tbx = document.getElementById(txtbx_id);  
    div.removeChild(tbx);
    */
    let element = document.getElementById(element_id);
    while (element.firstChild)
    {
        element.removeChild(element.firstChild);
    }
}

function showInputExampleDiv(divName, button)
{ 
    if(document.getElementById(divName).style.display == "none")
    {
        document.getElementById(divName).style.display = "block";
        document.getElementById(button).innerHTML = "Aizvērt paraugu";
    }
    else
    {
        document.getElementById(divName).style.display = "none";
        document.getElementById(button).innerHTML = "Parādīt paraugu";
    }
}

function showDiv(divname)
{ 
    if(document.getElementById(divname).style.display == "none")
    {
        document.getElementById(divname).style.display = "block";
    }
    else
    {
        document.getElementById(divname).style.display = "none";
    }
}

function handleClick(myRadio) {
    
    if(myRadio.value == 'all_courses')
    {
        document.getElementById("facultiesDropdownList").style.display = "none";
        document.getElementById("programsDropdownList").style.display = "none";
    }
    else if(myRadio.value == 'courses_faculty')
    {
        document.getElementById("programsDropdownList").style.display = "none";
        var facultiesDropdownList = document.getElementById("facultiesDropdownList");
        if (facultiesDropdownList.style.display === "none") 
        {
            facultiesDropdownList.style.display = "block";
        }
    }
    else if(myRadio.value == 'courses_program')
    {
        document.getElementById("facultiesDropdownList").style.display = "none";
        var programsDropdownList = document.getElementById("programsDropdownList");
        if (programsDropdownList.style.display === "none") 
        {
            programsDropdownList.style.display = "block";
        }
    }
    else if(myRadio.value == 'c_courses')
    {
        document.getElementById("facultiesDropdownList").style.display = "none";
        document.getElementById("programsDropdownList").style.display = "none";
    }
    else if(myRadio.value == 'direct_results')
    {
        document.getElementById("direct_results").style.display = "block";
        document.getElementById("linked_results").style.display = "none";
    }
    else if(myRadio.value == 'linked_results')
    {
        document.getElementById("direct_results").style.display = "none";
        document.getElementById("linked_results").style.display = "block";
    }
}

function c_courses_chbox_change()
{
    if (document.getElementById('c_courses_chbox').checked) 
    {
        document.getElementById("select_faculty_and_program").style.display = "none";
        document.getElementById("non_c_course_results").style.display = "none";
    }
    else
    {
        document.getElementById("select_faculty_and_program").style.display = "block";
        document.getElementById("non_c_course_results").style.display = "block";
    } 
}

function eng_chbox_change()
{
    if (document.getElementById('eng_chbox').checked) 
    {
        document.getElementById("course_name_eng_input").style.display = "none";
    }
    else
    {
        document.getElementById("course_name_eng_input").style.display = "block";
    } 
}

function userTypeOnChange(selectUserType)
{
    if(selectUserType.value != 1)
    {
        document.getElementById("is_lecturer_chbox").style.display = "block";
    }
    else
    {
        document.getElementById("is_lecturer_chbox").style.display = "none";
    }
}

$(document).ready(function() {
    
    $('.delete-user').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if(confirm('Vai tiešām vēlaties izdzēst lietotāju?'))
        {   
            $(e.target).closest('form').submit(); // Post the surrounding form
        }
    });
    
    $('.delete-course').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if(confirm('Vai tiešām vēlaties izdzēst studiju kursu?'))
        {   
            $(e.target).closest('form').submit();
        }
    });
    
    $('.delete-catalog').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if(confirm('Vai tiešām vēlaties izdzēst studiju kursu katalogu?'))
        {   
            $(e.target).closest('form').submit();
        }
    });
    
    $('.delete-faculty').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if(confirm('Vai tiešām vēlaties izdzēst fakultāti?'))
        {   
            $(e.target).closest('form').submit();
        }
    });
    
    $('.delete-study-program').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if(confirm('Vai tiešām vēlaties izdzēst studiju programmu?'))
        {   
            $(e.target).closest('form').submit();
        }
    });
    
    $('.delete-direction').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if(confirm('Vai tiešām vēlaties izdzēst studiju virzienu?'))
        {   
            $(e.target).closest('form').submit();
        }
    });
    
    $('.delete-result').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if(confirm('Vai tiešām vēlaties izdzēst studiju programmas studiju rezultātu?'))
        {   
            $(e.target).closest('form').submit();
        }
    });

});

function checkAllCheckboxes(div_id)
{
    var checkboxes = document.querySelectorAll('#' + div_id + ' input[type="checkbox"]');
    for(var i = 0; i < checkboxes.length; i++)
    {
        var checkbox = checkboxes[i];
        if(document.getElementById("check_all").checked)
        {
            checkbox.checked = true;
        }
        else
        {
            checkbox.checked = false;
        }
    }

}

function showFileUploadResult(divName, button)
{
    if(document.getElementById(divName).style.display == "none")
    {
        document.getElementById(divName).style.display = "block";
        document.getElementById(button).innerHTML = "Paslēpt faila nolasīšanas rezultātus";
    }
    else
    {
        document.getElementById(divName).style.display = "none";
        document.getElementById(button).innerHTML = "Parādīt faila nolasīšanas rezultātus";
    }
}
