namespace SearchAlgo;

public class SearchHandler
{
    public bool SearchLinear<T>(List<T> data, T value) where T : IComparable<T>
    {
        foreach (var n in data)
        {
            if (n.CompareTo(value) == 0) return true;
        }
        return false;
    }
}