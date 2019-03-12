function gf_apply_rules(a,b,c){var d=0;jQuery(document).trigger("gform_pre_conditional_logic",[a,b,c]);for(var e=0;e<b.length;e++)gf_apply_field_rule(a,b[e],c,function(){++d==b.length&&(jQuery(document).trigger("gform_post_conditional_logic",[a,b,c]),window.gformCalculateTotalPrice&&window.gformCalculateTotalPrice(a))})}function gf_check_field_rule(a,b,c,d){if(!window.gf_form_conditional_logic||!window.gf_form_conditional_logic[a]||!window.gf_form_conditional_logic[a].logic[b])return"show";var e=window.gf_form_conditional_logic[a].logic[b],f=gf_get_field_action(a,e.section);return"hide"!=f&&(f=gf_get_field_action(a,e.field)),f}function gf_apply_field_rule(a,b,c,d){var e=gf_check_field_rule(a,b,c,d);gf_do_field_action(a,e,b,c,d);var f=window.gf_form_conditional_logic[a].logic[b];f.nextButton&&(e=gf_get_field_action(a,f.nextButton),gf_do_next_button_action(a,e,b,c))}function gf_get_field_action(a,b){if(!b)return"show";for(var c=0,d=0;d<b.rules.length;d++){gf_is_match(a,b.rules[d])&&c++}return"all"==b.logicType&&c==b.rules.length||"any"==b.logicType&&c>0?b.actionType:"show"==b.actionType?"hide":"show"}function gf_is_match(a,b){var c,d=jQuery,e=b.fieldId,f=gformExtractFieldId(e),g=gformExtractInputIndex(e),h=!1!==g;c=d(h?"#input_{0}_{1}_{2}".format(a,f,g):'input[id="input_{0}_{1}"], input[id^="input_{0}_{1}_"], input[id^="choice_{0}_{1}_"], select#input_{0}_{1}, textarea#input_{0}_{1}'.format(a,b.fieldId));var i=-1!==d.inArray(c.attr("type"),["checkbox","radio"]),j=i?gf_is_match_checkable(c,b,a,f):gf_is_match_default(c.eq(0),b,a,f);return gform.applyFilters("gform_is_value_match",j,a,b)}function gf_is_match_checkable(a,b,c,d){var e=!1;return a.each(function(){var a=jQuery(this),f=gf_get_value(a.val()),g=-1!==jQuery.inArray(b.operator,["<",">"]),h=-1!==jQuery.inArray(b.operator,["contains","starts_with","ends_with"]);if(f==b.value||g||h)return a.is(":checked")?"gf_other_choice"==f&&(f=$("#input_{0}_{1}_other".format(c,d)).val()):f="",gf_matches_operation(f,b.value,b.operator)?(e=!0,!1):void 0}),e}function gf_is_match_default(a,b,c,d){for(var e=a.val(),f=e instanceof Array?e:[e],g=0,h=0;h<f.length;h++){var i=!f[h]||f[h].indexOf("|")>=0,j=gf_get_value(f[h]),k=gf_get_field_number_format(b.fieldId,c,"value");k&&!i&&(j=gf_format_number(j,k));gf_matches_operation(j,b.value,b.operator)&&g++}return"isnot"==b.operator?g==f.length:g>0}function gf_format_number(a,b){return decimalSeparator=".","currency"==b?decimalSeparator=gformGetDecimalSeparator("currency"):"decimal_comma"==b?decimalSeparator=",":"decimal_dot"==b&&(decimalSeparator="."),a=gformCleanNumber(a,"","",decimalSeparator),a||(a=0),number=a.toString(),number}function gf_try_convert_float(a){var b="decimal_dot";if(gformIsNumeric(a,b)){var c="decimal_comma"==b?",":".";return gformCleanNumber(a,"","",c)}return a}function gf_matches_operation(a,b,c){switch(a=a?a.toLowerCase():"",b=b?b.toLowerCase():"",c){case"is":return a==b;case"isnot":return a!=b;case">":return a=gf_try_convert_float(a),b=gf_try_convert_float(b),!(!gformIsNumber(a)||!gformIsNumber(b))&&a>b;case"<":return a=gf_try_convert_float(a),b=gf_try_convert_float(b),!(!gformIsNumber(a)||!gformIsNumber(b))&&a<b;case"contains":return a.indexOf(b)>=0;case"starts_with":return 0==a.indexOf(b);case"ends_with":var d=a.length-b.length;if(d<0)return!1;return b==a.substring(d)}return!1}function gf_get_value(a){return a?(a=a.split("|"),a[0]):""}function gf_do_field_action(a,b,c,d,e){for(var f=window.gf_form_conditional_logic[a],g=f.dependents[c],h=0;h<g.length;h++){var i=0==c?"#gform_submit_button_"+a:"#field_"+a+"_"+g[h],j=f.defaults[g[h]];do_callback=h+1==g.length?e:null,gf_do_action(b,i,f.animation,j,d,do_callback,a),gform.doAction("gform_post_conditional_logic_field_action",a,b,i,j,d)}}function gf_do_next_button_action(a,b,c,d){gf_do_action(b,"#gform_next_button_"+a+"_"+c,window.gf_form_conditional_logic[a].animation,null,d,null,a)}function gf_do_action(a,b,c,d,e,f,g){var h=jQuery(b);if(h.data("gf-disabled-assessed")||(h.find(":input:disabled").addClass("gf-default-disabled"),h.data("gf-disabled-assessed",!0)),"show"==a)if(h.find("select").each(function(){$select=jQuery(this),$select.attr("tabindex",$select.data("tabindex"))}),c&&!e)h.length>0?(h.find(":input:hidden:not(.gf-default-disabled)").prop("disabled",!1),h.slideDown(f)):f&&f();else{var i=h.data("gf_display");""!=i&&"none"!=i||(i="list-item"),h.find(":input:hidden:not(.gf-default-disabled)").prop("disabled",!1),h.css("display",i),f&&f()}else{var j=h.children().first();if(j.length>0){gform.applyFilters("gform_reset_pre_conditional_logic_field_action",!0,g,b,d,e)&&!gformIsHidden(j)&&gf_reset_to_default(b,d)}h.find("select").each(function(){$select=jQuery(this),$select.data("tabindex",$select.attr("tabindex")).removeAttr("tabindex")}),h.data("gf_display")||h.data("gf_display",h.css("display")),c&&!e?h.length>0&&h.is(":visible")?h.slideUp(f):f&&f():(h.hide(),h.find(":input:hidden:not(.gf-default-disabled)").prop("disabled",!0),f&&f())}}function gf_reset_to_default(a,b){var c=jQuery(a).find(".gfield_date_month input, .gfield_date_day input, .gfield_date_year input, .gfield_date_dropdown_month select, .gfield_date_dropdown_day select, .gfield_date_dropdown_year select");if(c.length>0)return void c.each(function(){var a=jQuery(this);if(b){var c="d";a.parents().hasClass("gfield_date_month")||a.parents().hasClass("gfield_date_dropdown_month")?c="m":(a.parents().hasClass("gfield_date_year")||a.parents().hasClass("gfield_date_dropdown_year"))&&(c="y"),val=b[c]}else val="";"SELECT"==a.prop("tagName")&&""!=val&&(val=parseInt(val,10)),a.val()!=val?a.val(val).trigger("change"):a.val(val)});var d=jQuery(a).find('select, input[type="text"]:not([id*="_shim"]), input[type="number"], textarea'),e=0;if(b&&d.parents(".ginput_list").length>0&&d.length<b.length)for(;d.length<b.length;)gformAddListItem(d.eq(0),0),d=jQuery(a).find('select, input[type="text"]:not([id*="_shim"]), input[type="number"], textarea');d.each(function(){var a="",c=jQuery(this);if("gf_other_choice"==c.prev("input").attr("value"))a=c.attr("value");else if(jQuery.isArray(b))a=b[e];else if(jQuery.isPlainObject(b)){if(!(a=b[c.attr("name")])){var d=c.attr("id").split("_").slice(2).join(".");a=b[d]}}else b&&(a=b);c.is("select:not([multiple])")&&!a&&(a=c.find("option").not(":disabled").eq(0).val()),c.val()!=a?(c.val(a).trigger("change"),c.is("select")&&c.next().hasClass("chosen-container")&&c.trigger("chosen:updated")):c.val(a),e++}),jQuery(a).find('input[type="radio"], input[type="checkbox"]:not(".copy_values_activated")').each(function(){var a=!!jQuery(this).is(":checked"),c=!!b&&jQuery.inArray(jQuery(this).attr("id"),b)>-1;a!=c&&("checkbox"==jQuery(this).attr("type")?jQuery(this).trigger("click"):jQuery(this).prop("checked",c).change())})}var __gf_timeout_handle;gform.addAction("gform_input_change",function(a,b,c){if(window.gf_form_conditional_logic){var d=rgars(gf_form_conditional_logic,[b,"fields",gformExtractFieldId(c)].join("/"));d&&gf_apply_rules(b,d)}},10);