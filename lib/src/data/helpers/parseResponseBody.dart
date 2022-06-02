import 'dart:convert';

parseResponseBody(String responseBody) {
  try {
    return jsonDecode(responseBody);
  } catch (e) {
    return responseBody;
  }
}
