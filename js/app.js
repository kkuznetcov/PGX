
$(document).ready(function(){
  let data = new Array();

  /**
   * Loading data
   */

  let loadData = (action, data) => {
    $.ajax({   
      url: 'ajax.php',
      type: 'POST',
      dataType : 'json',
      data: {
        action : action,
        data : data
      },
      success: function(response) {
        if(response.type == 'categories'){
          $('.list-group__container').html(response.data);
        }else if (response.type == 'tableData'){
          $('#nav-tabContent').html(response.data);
        } else if (response.type = 'popsData'){
          $('.modals').html(response.data);
        }
        
        clearArray(data);
      }  
    }); 
  }

  let displayTable = (curCategory) => {
    setTimeout( () => { 
      if ($('.tab-pane[role="tablepanel"]').hasClass('active')){
        $('.tab-pane[role="tablepanel"].active').removeClass('active');
        $('.tab-pane[data-category-name="'+ curCategory +'"]').addClass('active');
      }else{
        $('.tab-pane[data-category-name="'+ curCategory +'"]').addClass('active');
      }
    }, 100);
  }

  let getAllPillsCategories = () => {
    let pillsCategoriesId = new Array();
    $.each($('.nav-link'), (indexInArray, valueOfElement) => {
      pillsCategoriesId.push($(valueOfElement).data('category-id'));
    });
    return pillsCategoriesId;
  }

  loadData('loadCategories', getAllPillsCategories());

  // Load data when application starts
  // loadData('loadCategories', new Array({idCategory : 1})); 
  // setTimeout( () => { 
  //   loadData('loadTable', new Array({geneName : $('.list-group-item.active').text()}));
  // }, 50);

  let getAllTransportCategories = () => {
    let transportCategories = new Array();
    $.each($('.list-group-item'), (indexInArray, valueOfElement) => {
      transportCategories.push($(valueOfElement).text());
    });
    return transportCategories;
  }

  setTimeout( () => { 
    loadData('loadTable', getAllTransportCategories()); 
    displayTable($('.list-group.active').find('.list-group-item.active').text());
  }, 100);
  
  let getAllDrugGroups = () => {
    let drugGroupsArr = new Array();

    $.each($('.someclass'), (indexInArray, valueOfElement) => { 
       drugGroupsArr.push($(valueOfElement).data('specialization-name').toLowerCase());
    });

    return drugGroupsArr;
  }

  loadData('loadPops', getAllDrugGroups());
  
  $(document).on('click', '.nav-link', (e) => {
    e.preventDefault();
    $('.list-group.active').toggleClass('active');
    $('.list-group[data-parent-id="'+ $(e.target).data('category-id') +'"]').toggleClass('active');
    displayTable($('.list-group.active').find('.list-group-item.active').text());
  })

  $(document).on('click', '.list-group-item', (e) => {
    e.preventDefault();
    displayTable($(e.target).text());
  });


  /**
   * Clear array
   */

  let clearArray = (arr) => {
    arr.splice(0, arr.length);
  }

  /**
   * Checkbox click events
   */

  $(document).on('change', 'input[type="checkbox"][data-collapse="true"]', (e) => {
    e.preventDefault();
    let inputscontainer = $(e.target).closest('.card').find('#' + $(e.target).data('collapse-target'));
    $.each($(inputscontainer).find('input[type="checkbox"]'), function (indexInArray, valueOfElement) { 
      if ($(e.target).prop('checked')){
        $(valueOfElement).prop('checked', true);
      }else{
        $(valueOfElement).prop('checked', false);
      }
    });
  })

  $(document).on('change', '.checkbox__modal', (e) => {
    e.preventDefault();
    let modal = $('#' + $(e.target).attr('name'));
    $.each(modal.find('input[type="checkbox"]'), function (indexInArray, valueOfElement) { 
      if ($(e.target).prop('checked')){
        $(valueOfElement).prop('checked', true).change();
      }else{
        $(valueOfElement).prop('checked', false).change();
      }
    });
  });

  let drugs = new Array();
  $(document).on('change', '.drug-checkbox', (e) => {
    let drugName = $('label[for="'+$(e.target).attr("name")+'"]')[0].innerText;
    let obj = [drugName];
    if(e.target.checked){
      drugs.push(obj);
    }else{
      drugs.forEach((element, index) => {
        if (element.toString() == obj.toString()){
          drugs.splice(index, 1);
          return false;
        }
      });
    }
  });

  document.getElementById('generate-pdf1').addEventListener('click', (e) => {
    e.preventDefault();
    let columns = new Array();
    $.each($('.checkbox2:checked'), function (index, value) {
      let cells = $(this).closest('tr')[0].cells;
      let gen = $(this).closest('.tab-pane').data('category-name');
      let genotype = $(this).closest('tr').find('.select').val();
      let genotypeNum = $(this).closest('tr').find('.select option:selected').data('genotype-num');
      let obj = [cells[0].innerText, cells[1].innerText, cells[2].innerText, gen, genotype, genotypeNum];
      columns.push(obj);
    });

    let formData = $('#pdf-form').serialize();
    let jsonColumns = JSON.stringify(columns);
    let jsonDrugs = JSON.stringify(drugs);

    $('#formData').val(formData);
    $('#columns').val(jsonColumns);
    $('#drugs').val(jsonDrugs);
    $('#form-send').submit();
  });
}); 