#include <limits.h>
#include "sample1.h"
#include "gtest/gtest.h"
TEST(f, test_1){
EXPECT_EQ(1,f(1));
}
TEST(f, test_2){
EXPECT_EQ(1,f(2));
}
