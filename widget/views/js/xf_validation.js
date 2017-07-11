var rules = $('p#xf_rules').text();
rules = JSON.parse(rules);
var form = $('#xf_form');
// var form_rules = {};

var rows = $('.xf_row');

// var a = {
//     equal: {
//         r: '^(.){1,20}$',
//         m: 'equal'
//     },
//     not_equal: {
//         r: '^(.){1,20}$',
//         m: 'not_equal'
//     },
//     greater_than: {
//         r: '^\d+$',
//         m: 'greater_tha'
//     },
//     less_than: {
//         r: '^\d+$',
//         m: 'less_than'
//     },
//     greater_or_equal: {
//         r: '^\d+$',
//         m: 'greater_or_equal'
//     },
//     less_or_equal: {
//         r: '^\d+$',
//         m: 'less_or_equal'
//     },
//     in: {
//         r: '(((.*),\s)+)|(^\d+(,*\s*)*$)',
//         m: 'in'
//     },
//     not_in: {
//         r: '(((.*),\s)+)|(^\d+(,*\s*)*$)',
//         m: 'not_in'
//     },
//     between: {
//         r: "^\d*(\.|,)*\d+,\s\d+(\.|,)*\d+$",
//         m: 'between'
//     },
//     not_between: {
//         r: "^\d*(\.|,)*\d+,\s\d+(\.|,)*\d+$",
//         m: 'not_between'
//     },
//     like: {
//         r: '(.*)',
//         m: 'like'
//     },
//     not_like: {
//         r: '(.*)',
//         m: 'not_like'
//     },
//     null: {
//         r: '^(.){1,20}$',
//         m: 'null'
//     },
//     not_null: {
//         r: '^(.){1,20}$',
//         m: 'not_null'
//     }
// };

$.validator.addMethod(
    'regex',
    function (val, elem, regex) {
        var re = new RegExp(regex);
        return this.optional(elem) || re.test(val)
    },
    'Field is invalid'
);

//------------------

$(form).on('submit', function (e) {

    $(form).validate();
    $.each($(rows), function (e) {
        var operator = $(this).find('select');
        var value = $(this).find('input[type=text]');
        var field_name = $(value).attr('name');
        value.rules('add',{
            regex:rules[$(operator).val()]
        })
    });
    if(!$(form).valid()){
        e.preventDefault();
    }
});

//------------------

//
// function getRules() {
//     var form_rules = {};
//
//     $.each($(rows), function (e) {
//         var operator = $(this).find('select');
//         var value = $(this).find('input[type=text]');
//         var field_name = $(value).attr('name');
//         form_rules[field_name] = {regex: rules[$(operator).val()]};
//     });
//
//     return form_rules;
// }

// function go(form_rules) {
//     var validator = $(form).validate({
//         rules: getRules(),
//         onsubmit: true,
//         onfocusout: false,
//         onkeyup: false,
//         onclick: false
//     });
//     if(!$(form).valid()){
//         return validator.resetForm();
//     }
// }
// validator.resetForm();

//////////////////////////////////////////

// var fields = [], selects = [], inputs = {};
// $(form).on('submit', function (e) {
//     e.preventDefault();
//     fields = $(form).find(':input');
//     $.each(fields, function (i) {
//         var f_name = $(this).attr('data-field-name');
//         if (f_name !== undefined) {
//             inputs[f_name] = [];
//         }
//     });
//     $.each(fields, function (i) {
//         var f_name = $(this).attr('data-field-name');
//         if (f_name !== undefined) {
//             inputs[f_name].elem = this;
//             switch (this.tagName.toLowerCase()) {
//                 case 'select':
//                     inputs[f_name].operator = $(this).val();
//                     break;
//                 case 'input':
//                     inputs[f_name].value = $(this).val();
//                     break;
//             }
//             if ($(this).val() === '') delete  inputs[f_name];
//         }
//     });
//
//     var c = 0;
//     $.each(inputs, function (i, val) {
//         var pattern = rules[val.operator].toString();
//         pattern = new RegExp(pattern.trim());
//         var str = val.value.toString();
//         if (str.match(pattern) === null) {
//             $(val.elem).css({color: 'red'});
//             c += 1;
//         }
//         else if (str.match(pattern) !== null) {
//             $(val.elem).css({color: 'black'});
//         }
//     });
//     if (c === 0 && !$.isEmptyObject(inputs)) {
//         this.submit();
//     }
// });

/////////////////////////