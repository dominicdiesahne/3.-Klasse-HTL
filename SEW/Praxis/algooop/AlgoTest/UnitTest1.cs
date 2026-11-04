using Recursive;
using SearchAlgo;

namespace AlgoTest;

public class Tests
{
    [SetUp]
    public void Setup()
    {
    }

    [Test]
    public void TestMultiply()
    {
        Factor f = new Factor();

        var result = f.Multiply(5, 8);
        Assert.That(result, Is.EqualTo(40));

        var resultPow = f.Pow(3);
        Assert.That(resultPow, Is.EqualTo(8));
        
        resultPow = f.Pow(10);
        Assert.That(resultPow, Is.EqualTo(1024));
        
        resultPow = f.PowRec(10);
        Assert.That(resultPow, Is.EqualTo(1024));

        resultPow = f.SumIt(2);
        Assert.That(resultPow, Is.EqualTo(3));
        
        resultPow = f.SumRec(2);
        Assert.That(resultPow, Is.EqualTo(3));

        resultPow = f.FiboRec(5);
        Assert.That(resultPow, Is.EqualTo(5));
    }

    [Test]
    public void TestSearch()
    {
        List<int> data = [3, 2, 1];

        var searchHandler = new SearchHandler();
        Assert.That(searchHandler.SearchLinear(data, 3), Is.True);
        Assert.That(searchHandler.SearchLinear(data, 5), Is.False);
    }
}