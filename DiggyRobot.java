package diggyrobot;

/**
 *
 * @author Akshay Sutar
 * Created 30 August 2017
 */
// Enumeration to store Directions
enum Direction{
    NORTH,
    EAST,
    SOUTH
    ,WEST;
}

public class DiggyRobot {
    
    int x,y; // position in x-y coordinate
    String direction; // direction in string
    Direction enumdirection; // direction in Enumeration
    
    public DiggyRobot(int x,int y, Direction d){
        this.x=x;
        this.y=y;
        this.enumdirection = d;
    }
    
    public void Rotate(char d){
         int val = enumdirection.ordinal(); ;
        if(Character.toUpperCase(d)== 'R'){  // Rotate Clockwise
            val = (val + 1) %4;
        }else if(Character.toUpperCase(d)== 'L'){ // Rotate AntiClockwise
            if(--val<0)
                val=3;
        }
         
            switch(val){
                case 0:
                    enumdirection=enumdirection.NORTH;
                    break;
                case 1:
                    enumdirection=enumdirection.EAST;
                    break;
                 case 2:
                    enumdirection=enumdirection.SOUTH;
                    break;
                case 3:
                    enumdirection=enumdirection.WEST;
                    break;    
            }   // switch
            direction = enumdirection.toString();
    }// end of Rotate
    
    public void Walk(int steps){
        switch(this.enumdirection){
            case NORTH:
                y  = y + steps;
                break;
            
            case EAST:
                x = x + steps;
                break;
                
            case SOUTH:
                y = y - steps;
                break;
                
            case WEST:
                x = x - steps;
                break;
        }// switch
    }// end of Walk
    
    public void DisplayPosition(){
        System.out.println(x+" "+y+" "+direction);        
    }// end of DisplayPosition

    public static void main(String[] args) {
      
        DiggyRobot Diggy = new DiggyRobot(Integer.parseInt(args[0]),Integer.parseInt(args[1]),Direction.valueOf(args[2]));
        String input = args[3];
        
        OUTER:
        for (int i = 0; i< input.length(); ++i) {
            switch (Character.toUpperCase(input.charAt(i))) {
                case 'R':
                case 'L':
                    Diggy.Rotate(Character.toUpperCase(input.charAt(i)));
                    break;
                case 'W':
                    Diggy.Walk(Character.getNumericValue(input.charAt(++i)));
                    break;
                default:
                    System.out.println("Invalid Input");
                    break OUTER; //  break out of for loop
            }// switch
        }// for
        Diggy.DisplayPosition();
        
    }// end of main
    
}
