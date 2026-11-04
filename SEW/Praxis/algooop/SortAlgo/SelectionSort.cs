namespace SortAlgo;

public class SelectionSort
{
    public void Sort(int[] values)
    {
        for (int i = 0; i < values.Length - 1; i++)
        {
            var min = i;
            for (int j = 0; j < values.Length; j++)
            {
                if (values[j] < values[min])
                {
                    min = j;
                }
            }
            int temp = values[i];
            values[i] = values[min];
            values[min] = temp;
        }

        
    }
}