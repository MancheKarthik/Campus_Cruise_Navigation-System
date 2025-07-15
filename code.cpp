/******************************************************************************

                              Online C++ Compiler.
               Code, Compile, Run and Debug C++ program online.
Write your code in this editor and press "Run" button to compile and execute it.

*******************************************************************************/

#include <iostream>
using namespace std;

int main()
{
    int n;
    cin>>n;
    int sum=0;
    int result=0;
    while(n>0){
        int rem=n%10;
        sum=sum+rem;
        n/10;
        result=sum;
        

    }
    cout<<result;
    
}