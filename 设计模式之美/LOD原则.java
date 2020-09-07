
public class Document {
    private Html html;
    private String url;

    public Document(String url, Html html) {
        this.html = html;
        this.url = url;
    }
    // ...
}

// 通过一个工厂方法来创建 Document
public class DocumentFactory {
    private HtmlDownloader downloader;

    public DocumentFactory(HtmlDownloader downloader) {
        this.downloader = downloader;
    }

    public Document createDocument(String url) {
        Html html = downloader.downloadHtml(url);
        return new Document(url, html);
    }
}

//////////////////////////////////

public class Serialization {
  public String serialize(Object object) {
    String serializedResult = ...;
    //...
    return serializedResult;
  }

  public Object deserialize(String str) {
    Object deserializedResult = ...;
    //...
    return deserializedResult;
  }
}



////////////////////////////////////
public interface Serializable {
    String serialize(Object object);
}

public interface Deserializable {
    Object deserialize(String text);
}

public class Serialization implements Serializable, Deserializable {
  @Override
  public String serialize(Object object) {
    String serializedResult = ...;
    ...
    return serializedResult;
  }

  @Override
  public Object deserialize(String str) {
    Object deserializedResult = ...;
    ...
    return deserializedResult;
  }
}

public class DemoClass_1 {
    private Serializable serializer;

  public Demo(Serializable serializer) {
    this.serializer = serializer;
  }
    // ...
}

public class DemoClass_2 {
    private Deserializable deserializer;

  public Demo(Deserializable deserializer) {
    this.deserializer = deserializer;
  }
    // ...
}

////////////////////

interface Serializable
interface Deserializable

Serialization implements Serializable,Deserializable

class A{
    public Demo(Serializable serializer){}
}

class B{
    public Demo(Deserializable deserializer){}
}

