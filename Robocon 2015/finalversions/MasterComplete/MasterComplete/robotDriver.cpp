/*
 * robotDriver.cpp
 *
 * Created: 6/6/2015 2:57:57 PM
 *  Author: Sagar
 */ 

#include "robotDriver.h"


robotDriver::robotDriver()
{
	float inverseOblique[3][4]={{-.353553,-0.353553,0.353553,0.353553},{0.353553,-0.353553,-0.353553,0.353553},{0.25,0.25,0.25,0.25}};
	volatile float temp[4][3]={{0,1,1}, {-1,0,1}, {0,-1,1},{1,0,1}};
	robotAngle=0;
	for(int i=0;i<4;i++)
	{
		targetM_Velocity[i]=0;
	}
	
	for(int j=0;j<3;j++)
	{
		targetR_Velocity[j]=0;
	}
	
	for(int i=0;i<4;i++)
	{
		for(int j=0;j<3;j++)
		{
			couplingMatrix[i][j]=temp[i][j];
		}
	}
	
	for(int i=0;i<3;i++)
	{
		for(int j=0;j<4;j++)
		{
			inverseC_Matrix[i][j]=inverseOblique[i][j];
		}
	}
}

robotDriver::robotDriver(bool rightAngle)
{
	float oblique[4][3]={{-0.707,0.707,1}, {-0.707,-0.707,1}, {0.707,-0.707,1},{0.707,0.707,1}};
    float right[4][3]={{0,1,1}, {-1,0,1}, {0,-1,1},{1,0,1}};
	float inverseOblique[3][4]={{-0.353553,-0.353553,0.353553,0.353553},{0.353553,-0.353553,-0.353553,0.353553},{0.25,0.25,0.25,0.25}};
	for(int i=0;i<4;i++)
	{
		targetM_Velocity[i]=0;
	}
	
	for(int j=0;j<3;j++)
	{
		targetR_Velocity[j]=0;
	}
	
	if(rightAngle==true)
	{
	for(int i=0;i<4;i++)
	{
		for(int j=0;j<3;j++)
		{
			couplingMatrix[i][j]=right[i][j];
		}
	}
	}
	else
	{
		for(int i=0;i<4;i++)
		{
			for(int j=0;j<3;j++)
			{
				couplingMatrix[i][j]=oblique[i][j];
			}
		}
	}
	
	for(int i=0;i<3;i++)
	{
		for(int j=0;j<4;j++)
		{
			inverseC_Matrix[i][j]=inverseOblique[i][j];
		}
	}
}

void robotDriver::getMotorVelocity(unsigned char data)
{
	static int x_velocity=0, y_velocity=0,rotate=0;	 

	 if(data<100)
	 {
		 x_velocity = data-50;
	 }
	 else if (data>100 && data<200)
	 {
		 y_velocity = data-150;
	 }
     else if(data>=220 && data<=240)
	    rotate=230-data;
		
		/*if(abs(x_velocity)>=abs(y_velocity))
		y_velocity=0;
		else
		if(abs(x_velocity)<abs(y_velocity))
		x_velocity=0;*/
		
	 targetR_Velocity[0]=(float)x_velocity;
	 targetR_Velocity[1]=(float)y_velocity;
	 targetR_Velocity[2]=rotate*1.25;
	 
	 for(int i=0;i<4;i++)
	 {
		 targetM_Velocity[i] = 0;
	 }

	 for(int i=0;i<4;i++)

	 {
		 for(int j=0;j<3;j++)
		 {
			 targetM_Velocity[i] += couplingMatrix[i][j]*targetR_Velocity[j];
		 }

		 targetM_Velocity[i] =(int)((targetM_Velocity[i]+35.35)/70.70*255);

		 if(targetM_Velocity[i]<0)
		 targetM_Velocity[i]=0;
		 else if(targetM_Velocity[i]>255)
		 targetM_Velocity[i]=255;
	 }


}

void robotDriver::getRobotPosition(int *encoder)
{
	
	for(int i=0;i<4;i++)
	{
		currentM_Velocity[i]= encoder[i]*(encoderCircum/countsPerRev);
	}

	for(int i=0;i<3;i++)
	{
		currentR_Velocity[i] = 0;
	}

	for(int i=0;i<3;i++)
	{
		for(int j=0;j<4;j++)
		{
			currentR_Velocity[i] += inverseC_Matrix[i][j]*currentM_Velocity[j];
		}
	}

	robotPosition[0] += currentR_Velocity[0];
	robotPosition[1] += currentR_Velocity[1];
	robotPosition[2] += currentR_Velocity[2];
	robotAngle = robotPosition[2]*360/2.10;
	robotAngle =(int)robotAngle % 360;
	
}

void robotDriver::getRobotAngle(int angle)
{
	
}

void robotDriver::setRobotPosition(int* encoder)
{
	getRobotPosition(encoder);
	setRobotAngle((int)robotAngle);
	
}

void robotDriver::setRobotAngle(int angle)
{
  pid.SetInput(angle);
  pid.CalculatePID();
 // int adjust= pid.getPIDoutput();
  for(int i=0;i<4;i++)
  {
	  targetM_Velocity[i] += pid.getPIDoutput();
	  if(targetM_Velocity[i]>255)
	  targetM_Velocity[i]=255;
	  if(targetM_Velocity[i]<0)
	  targetM_Velocity[i]=0;
  }
 
}

void robotDriver::init_PID(int target)
{
	pid.PIDinitialize();
	pid.SetSamplefrequency(1);
	pid.SetTuningConstants(1.0,0.0,0.0);
	pid.SetTargetPoint((float)target,1);
    pid.SetOutputLimits(-127,127);
	pid.SetIntegralLimits(1,-50,50);
	
}
