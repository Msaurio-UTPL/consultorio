<?php
/**
* @author evilnapsis
* @brief Llama todos los archivos del framework LegoBox
**/

include "controller/Core.php";
include "controller/View.php";
include "controller/Module.php";
include "controller/Database.php";
include "controller/Executor.php";
//# include "controller/Session.php"; [remplazada]

// 22 enero 2017
include ("jpgraph-4.3.4/src/jpgraph.php"); 
include ("jpgraph-4.3.4/src/jpgraph_pie.php"); 
include ("jpgraph-4.3.4/src/jpgraph_pie3d.php"); 

include "controller/forms/lbForm.php";
include "controller/forms/lbInputText.php";
include "controller/forms/lbInputPassword.php";
include "controller/forms/lbValidator.php";

// 10 octubre 2014
include "controller/Model.php";
include "controller/Bootload.php";
include "controller/Action.php";

// 13 octubre 2014
include "controller/Request.php";


// 14 octubre 2014
include "controller/Get.php";
include "controller/Post.php";
include "controller/Cookie.php";
include "controller/Session.php";
include "controller/Lb.php";

// 26 diciembre 2014
include "controller/Form.php";
//print "autoload.php";

?>