var TITEMS = [ 
 ["CRM Milestone Search 3.0", "Help_AboutMilestoneSearch.htm", "1",
  ["CRM System Overview", "Help_CRMS_Overview.htm", "11"],
  ["Login", "Help_Login.htm", "11"],
  ["Advanced Search", "Help_AdvSearch.htm", "11"],
  ["Manage Candidate", "Help_InsUpdCand.htm", "11"],
  ["Manage Work Flow Action", "Help_InsUpdWFA.htm", "11"],
  ["Agent To-do list", "Help_Agent_To-do_list.htm", "11"],
  ["Percentage of Similarities", "Help_PerSimilarities.htm", "11"],
  ["Management Agent Administrator", "Help_AdminAccount.htm", "11"],
  ["Reports", "Help_Reports.htm", "11"],
  ["Glossary", "Help_Glossary.htm", "11"]
 ]
];


var FITEMS = arr_flatten(TITEMS);

function arr_flatten (x) {
   var y = []; if (x == null) return y;
   for (var i=0; i<x.length; i++) {
      if (typeof(x[i]) == "object") {
         var flat = arr_flatten(x[i]);
         for (var j=0; j<flat.length; j++)
             y[y.length]=flat[j];
      } else {
         if ((i%3==0))
          y[y.length]=x[i+1];
      }
   }
   return y;
}

