namespace Recursive;

// n! = 1*2*3*...*n
// 3! = 1*2*3 = 6
// 5! = 1*2*3*4*5 = 120

// f(n) = n * f(n-1)
// f(4) = 4 * f(3) = 4 * 6 = 24
// f(3) = 3 * f(2) = 3 * 2 = 6
// f(2) = 2 * f(1) = 2 * 1 = 2

// Rekursionsabbruch
// f(1) = 1
// f(0) = 1
public class Factor
{
    public int Calculate(int n)
    {
        var result = 1;
        for (int i = n; i > 0; i--)
        {
            result *= i;
        }
        return result; 
    }

    public int CalculateRecursive(int n)
    {
        // 1.) Rekursionsabbruch
        if (n == 1 || n == 0)
        {
            return 1;
        }
        // 2.) f(n) = n * f(n-1)
        return n *  CalculateRecursive(n - 1);
    }
    
    // 3 * 4 = 4 + 4 + 4
    // f(x, y) = x + f(x, y - 1)

    // f(x, 0) = 0;
    // f(4, 3) = 4 + f(4, 2) = 4 + 8 = 12
    // f(4, 2) = 4 + f(4, 1) = 4 + 4 = 8
    // f(4, 1) = 4 + f(4, 0) = 4 + 0 = 4
    //
    public int Multiply(int x, int y)
    {
        //Abbruchsbedingung
        if (y == 0)
        {
            return 0;
        }
        
        // Rekursionsregel
        return x + Multiply(x, y - 1);
    }
    
    // 2^4 = 2 * (2 * 2 * 2)
    // 2^3 = 2 * 2 * 2
    // Rekursionsregel
    // f(n) = 2 * f(n-1)
    // Abbruchsbedingung
    // f(0) = 1

    public int Pow(int n)
    {
        if (n == 0)
        {
            return 1;
        }

        return 2 * Pow(n - 1);
    }
    
    public int PowRec(int n)
    {
        if (n == 0)
        {
            return 1;
        }

        return Multiply(2, PowRec(n - 1));
    }
    // 1) Schreiben Sie Iterative und Rekursive Funktion die n mal den String "Flo ist der beste" ausgibt

    public string StringRepeatIt(int n)
    {
        if (n == 0)
        {
            return "";
        }

        var Flo = "Flo ist der beste";
        var result = "";
        for (int i = 0; i <= n; i++)
        {
            result += Flo; 
        }
        return result;
    }

    public string StringRepeatRec(int n)
    {
        if (n == 0)
        {
            return String.Empty;
        }

        return "Flo ist der beste" + "\n" + StringRepeatRec(n-1);
    }
    
    // 2) Schreiben Sie eine Iterative und Rekursive Funktion die alle Werte von 1 bis n aufsummiert
    // f(n) = 1 + 2 + 3 + ... + n

    public int SumIt(int n)
    {
        if (n == 0)
        {
            return 0;
        }
        var result = 0;
        for (int i = 0; i <= n ; i++)
        {
            result += i;
        }
        return result;
    }
    public int SumRec(int n)
    {
        if (n == 0)
        {
            return 0;
        }
        
        return n + SumRec(n - 1);
    }
    
    // Für die Fibonacci Folge gilt: Ein Folgenglied ist immer die Summe der 2 vorhergehenden Folgenglieder
    
    // f(0) = 0
    // f(1) = 1
    // f(n) = f(n - 1) + f(n - 2)
    // f(2) = f(1) + f(0) = 0 + 1 = 1

    public int FiboRec(int n)
    {
        if (n == 0)
        {
            return 0;
        }
        if (n == 1)
        {
            return 1;
        }
        return FiboRec(n - 1) + FiboRec(n - 2);
    }
}