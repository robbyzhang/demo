<?php
//print_r($_POST);
$fp = fopen("./data/sample1.h", "w");
fwrite($fp, "#ifndef GTEST_SAMPLES_SAMPLE1_H_\r\n");
fwrite($fp, "#define GTEST_SAMPLES_SAMPLE1_H_\r\n");

fwrite($fp, $_POST["fname"]);
fwrite($fp, "\r\n");

fwrite($fp, "#endif\r\n");
fclose($fp);

$fp = fopen("./data/sample1.cc", "w");
fwrite($fp, '#include "sample1.h"');
fwrite($fp, "\r\n");
fwrite($fp, $_POST["fimpl"]);
fclose($fp);


$fp = fopen("./data/sample1_unittest.cc", "w");
fwrite($fp, '#include <limits.h>');
fwrite($fp, "\r\n");
fwrite($fp, '#include "sample1.h"');
fwrite($fp, "\r\n");
fwrite($fp, '#include "gtest/gtest.h"');
fwrite($fp, "\r\n");

/*
  TEST(aaFactorialTest, Zero) {
  EXPECT_EQ(1, Factorial(0));
}
*/
$fname=$_POST["fname"];
$fun=substr($fname, strpos($fname, " ")+1, strpos($fname, "(")-strpos($fname, " ")-1);

//EXPECT_EQ(1, Factorial(-5));

for($i=1; $i<=5; $i++){
	$a = $_POST["input".$i];
	$b = $_POST["output".$i];
	$testname="test_".$i;
	if($a!="" && $b!="")
	{
		fwrite($fp, 'TEST('.$fun.", $testname){\r\n");
		fwrite($fp, "EXPECT_EQ(".$b.",".$fun."(".$a."));\r\n");
		fwrite($fp, "}\r\n");
	}
}
fclose($fp);
system("cd ./data && make > ./res.txt");
system("./data/sample1_unittest>>./data/res.txt" );


?>